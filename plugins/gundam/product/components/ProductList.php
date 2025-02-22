<?php

namespace Gundam\Product\Components;

use Cms\Classes\ComponentBase;
use Gundam\Product\Models\Category;
use Gundam\Product\Models\Product;
use function explode;

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

    }

    public function prepareVars()
    {
        $options = post('Filter', []);
        if (isset($options['price'])) {
            $options['price'] = explode('-', $options['price'][0]);
            $options['price'] = [
                'min' => $options['price'][0],
                'max' => $options['price'][1],
            ];
        }
        $products = Product::listProduct($options);
        $this->page['products'] = $products;
        $this->page['categories'] = Category::all();
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
