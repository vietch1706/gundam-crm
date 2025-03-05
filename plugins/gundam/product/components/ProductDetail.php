<?php

namespace Gundam\Product\Components;

use Cms\Classes\ComponentBase;
use Gundam\Product\Models\Product;
use October\Rain\Exception\ValidationException;
use function abort;

class ProductDetail extends ComponentBase
{
    public $product;

    public function componentDetails()
    {
        return [
            'name' => 'Product Detail',
            'description' => 'Displays details of a single product based on its slug.'
        ];
    }

    public function defineProperties()
    {
        return [
            'slug' => [
                'title' => 'Slug',
                'description' => 'The slug of the product to display.',
                'type' => 'string',
                'default' => '{{ :slug }}',
            ],
        ];
    }

    public function onRun()
    {
        $this->prepareVars();
    }

    public function prepareVars()
    {
        [$product, $productVariant] = $this->_resolveProduct();
        $relatedProducts = $this->_relatedProduct($product);
        $this->page['product'] = $product;
        $this->page['productVariant'] = $productVariant;
        $this->page['relatedProducts'] = $relatedProducts;
    }

    private function _relatedProduct($currentProduct)
    {
//        return Product::where('category_id', $currentProduct->category_id)
//            ->where('id', '!=', $currentProduct->id)
//            ->inRandomOrder()
//            ->get();
        return Product::where('id', '!=', $currentProduct->id)
            ->inRandomOrder()
            ->get();
    }

    private function _resolveProduct()
    {
        $productSlug = $this->param('slug');
        $productVariant = null;
        if (empty($productSlug)) {
            return [null, null];
        }

        $product = Product::where('slug', $productSlug)->first();
        #TODO: ve 404.
        if (!$product) {
            throw new ValidationException(['product' => 'Không tìm thấy sản phẩm']);
            abort(404);
        }

        if ($product->type == Product::TYPE_MULTI) {
            $productVariant = $product->product_variants;
        }

        return [$product, $productVariant];
    }
}
