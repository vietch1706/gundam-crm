<?php

namespace Gundam\General\Updates;

use Gundam\General\Models\SupportivePage;

class seed_supportive_pages extends \Seeder
{
    public function run()
    {
        $supportivePages = [
            ['id' => 1, 'title' => 'Chính sách mua hàng', 'content' => "Chính sách mua hàng", 'slug' => 'chinh-sach-mua-hang'],
            ['id' => 2, 'title' => 'Điều khoản và điều kiện', 'content' => "Điều khoản và điều kiện", 'slug' => 'dieu-khoan-va-dieu-kien'],
        ];

        foreach ($supportivePages as $page) {
            $model = new SupportivePage();
            $model->fill($page);
            $model->forceSave();
        }
    }
}
