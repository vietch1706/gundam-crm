<?php

namespace Gundam\Blog\Updates;

use Gundam\Blog\Models\Category;
use Seeder;
use function str_slug;

class seed_table_gundam_blog_category extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Sự Kiện',
            ],
            [
                'name' => 'Khuyến Mãi',
            ],
        ];
        foreach ($categories as $category) {
            $categoryModel = new Category();
            $categoryModel->name = $category['name'];
            $categoryModel->slug = str_slug($category['name'], '-');
            $categoryModel->save();
        }
    }
}
