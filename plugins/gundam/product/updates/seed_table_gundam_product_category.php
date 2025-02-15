<?php

namespace Gundam\Product\Updates;

use Gundam\Product\Models\Category;
use Seeder;
use function str_slug;

class seed_table_gundam_product_category extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Dòng mô hình khác',
            ],
            [
                'name' => 'Evangelion',
            ],
            [
                'name' => 'BASE ACTION (giá đỡ mô hình)'
            ],
            [
                'name' => 'RE-ment'
            ],
            [
                'name' => 'MONCOLLE'
            ],
            [
                'name' => 'Mô hình động vật - Khủng long'
            ],
            [
                'name' => 'GUNDAM BASE - Limited - PBANDAI'
            ],
            [
                'name' => 'Figure & Figure Rise'
            ],
            [
                'name' => 'Kyoukai Senki'
            ],
            [
                'name' => 'Candy Toys/Shokugan/Re-ment/Dòng Khác'
            ],
            [
                'name' => 'One Piece'
            ],
            [
                'name' => 'All Model Kit'
            ],
            [
                'name' => 'HG & EG BANDAI'
            ],
            [
                'name' => 'Hàng mới về'
            ],
            [
                'name' => '30MM & 30MS (Minutes Misions & Sisters)'
            ],
            [
                'name' => 'Sơn & Dung dịch chuyên dụng'
            ],
            [
                'name' => 'RG BANDAI'
            ],
            [
                'name' => 'SD BANDAI'
            ],
            [
                'name' => 'Kotobukiya'
            ],
            [
                'name' => 'Pokepla'
            ],
            [
                'name' => 'Build Customs'
            ],
            [
                'name' => 'Tools (Dụng cụ)'
            ]
        ];
        foreach ($categories as $category) {
            $categoryModel = new Category();
            $categoryModel->name = $category['name'];
            $categoryModel->slug = str_slug($category['name'], '-');
            $categoryModel->save();
        }
    }
}
