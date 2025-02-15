<?php

namespace Gundam\Product\Components;

use Cms\Classes\ComponentBase;
use Gundam\Product\Models\Product;
use Illuminate\Pagination\Paginator;

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
        $perPage = $this->property('limit');
        $currentPage = Paginator::resolveCurrentPage();
        $query = Product::query();
        $products = $query->paginate($perPage, $currentPage);
        $this->page['products'] = $products;
    }
}
