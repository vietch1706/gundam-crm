<?php

namespace Gundam\Product\Components;

use Cms\Classes\ComponentBase;
use Gundam\Product\Models\Category;
use Gundam\Product\Models\Product;
use October\Rain\Exception\ApplicationException;
use October\Rain\Exception\ValidationException;
use function get;

class ProductList extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name' => 'Danh sách sản phẩm',
            'description' => 'Hiển thị danh sách sản phẩm với các bộ lọc và phân trang.',
        ];
    }

    public function defineProperties()
    {
        return [
            'perPage' => [
                'title' => 'Số sản phẩm mỗi trang',
                'description' => 'Số lượng sản phẩm hiển thị mỗi trang',
                'default' => Product::PER_PAGE,
                'type' => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'Thuộc tính perPage chỉ có thể chứa số',
            ],
            'noProductsMessage' => [
                'title' => 'Thông báo không có sản phẩm',
                'description' => 'Thông báo hiển thị khi không có sản phẩm nào',
                'type' => 'string',
                'default' => 'Không có sản phẩm nào được tìm thấy',
            ],
            'sortOptions' => [
                'title' => 'Tùy chọn sắp xếp',
                'description' => 'Kích hoạt hoặc vô hiệu hóa các tùy chọn sắp xếp',
                'type' => 'checkbox',
                'default' => true,
            ],
            'filterPrice' => [
                'title' => 'Bộ lọc giá',
                'description' => 'Kích hoạt hoặc vô hiệu hóa bộ lọc giá',
                'type' => 'checkbox',
                'default' => true,
            ]
        ];
    }

    private function _buildFilterOptions(): array
    {
        $options = [];
        $categortModel = new Category();
        $category = get('category', null);

        if ($category) {
            $categortModel->validateCategory($category);
            $options['category'] = $category;
        }

        $options['price'] = [
            'min' => get('min', Product::PRICE_RANGES['min']),
            'max' => get('max', Product::PRICE_RANGES['max']),
        ];

        $this->_validatePriceRange($options['price']);

        $sortBy = get('sortBy');
        if ($sortBy !== null) {
            $this->_validateSortOption($sortBy);
            $options['sortBy'] = $sortBy;
        }

        $orderBy = get('orderBy', Product::DEFAULT_ORDER);
        $this->_validateOrderOption($orderBy);
        $options['orderBy'] = $orderBy;

        $options['page'] = (int)get('page', Product::PAGE_DEFAULT);
        $options['perPage'] = (int)$this->property('perPage', Product::PER_PAGE);

        return $options;
    }


    private function _validatePriceRange(array $price): void
    {
        if ($price['min'] < Product::PRICE_RANGES['min'] ||
            $price['max'] > Product::PRICE_RANGES['max'] ||
            $price['min'] > $price['max']) {
            throw new ValidationException(['price' => 'Phạm vi giá không hợp lệ']);
        }
    }

    private function _validateSortOption(?string $sortBy): void
    {
        if ($sortBy !== null && !in_array($sortBy, Product::SORT_OPTIONS, true)) {
            throw new ValidationException(['sortBy' => 'Tùy chọn sắp xếp không hợp lệ']);
        }
    }

    private function _validateOrderOption(string $orderBy): void
    {
        if (!in_array($orderBy, Product::ORDER_OPTIONS, true)) {
            throw new ValidationException(['orderBy' => 'Tùy chọn thứ tự không hợp lệ']);
        }
    }

    private function _resolveCategory()
    {
        $categorySlug = $this->param('slug');

        if (empty($categorySlug)) {
            return null;
        }

        $category = Category::where('slug', $categorySlug)->first();

        if (!$category) {
            throw new ApplicationException('Danh mục không tồn tại');
        }

        return $category;
    }

    private function _setPageVariables(array $options, ?Category $category): void
    {
        if ($category && $category->slug) {
            $options['category'] = $category->slug;
        }

        $products = Product::listProduct($options);
        $categories = Category::orderBy('name')->get();

        $this->page['products'] = $products;
        $this->page['categories'] = $categories;
        $this->page['category'] = $category;
        $this->page['price'] = Product::PRICE_RANGES;
    }

    public function prepareVars()
    {
        try {
            $filterOptions = $this->_buildFilterOptions();
            $category = $this->_resolveCategory();
            $this->_setPageVariables($filterOptions, $category);
        } catch (ValidationException|ApplicationException $e) {
            $this->controller->vars['errorMessage'] = $e->getMessage();
            return $this->controller->run('404');

        } catch (\Exception $e) {
            \Log::error('Unexpected error in ProductList: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            $this->controller->vars['errorMessage'] = 'Đã xảy ra lỗi không mong muốn. Vui lòng thử lại sau.';
            return $this->controller->run('404');
        }
    }

    public function onProductFilter()
    {
        $this->prepareVars();
    }

    public function onRun()
    {
        $this->prepareVars();
    }
}
