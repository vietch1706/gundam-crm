<?php namespace Gundam\Product\Components;

use Cms\Classes\ComponentBase;
use Gundam\Product\Models\Category;

class CategoryList extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Product Category List',
            'description' => 'Display product category list.',
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun()
    {
        $this->page['categories'] = Category::all();
    }
}
