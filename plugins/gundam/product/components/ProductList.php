<?php

namespace Gundam\Product\Components;

use Cms\Classes\ComponentBase;
use Gundam\Product\Models\Category;
use Gundam\Product\Models\Product;
use Illuminate\Pagination\Paginator;
use Request;
use function count;

class ProductList extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name' => 'Product List',
            'description' => 'Display product list.',
        ];
    }

    public function defineProperties()
    {
        return [
            'limit' => [
                'title' => 'Number of products',
                'description' => 'How many products to display?',
                'default' => 2,
                'type' => 'string',
            ]
        ];
    }

    public function onRun()
    {
        $options = post('Filter', []);
        $perPage = $this->property('limit');
        $currentPage = Paginator::resolveCurrentPage();
        $query = Product::query();
        $categorySlug = Request::segment(1);
        $priceRange = explode('-', Request::input('price'));
        $priceMin = '';
        $priceMax = '';
        if (isset($priceRange) && count($priceRange) >= 2) {
            $priceMin = $priceRange[0];
            $priceMax = $priceRange[1];
        }
        if ($categorySlug != 'tat-ca-san-pham' && $categorySlug) {
            $query = $query->whereHas('category', function ($query) use ($categorySlug) {
                $query->where('slug', $categorySlug);
            });
        }
        if ($priceMin != '' && $priceMax != '') {
            $query = $query->whereBetween('price', [$priceMin, $priceMax]);
        } else {
            $query = $query->where('price', '>=', $priceMax);
        }
//        $products = $query->paginate($perPage, $currentPage);
        $products = Product::listingProduct($options);
        $this->page['products'] = $products;
        $this->page['categories'] = Category::all();
    }
}
