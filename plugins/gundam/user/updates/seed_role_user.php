<?php

namespace Skechers\User\updates;

use Backend\Models\UserRole;
use Gundam\User\Models\User;

class SeedRoleUser extends \Seeder
{
    public function run()
    {
        UserRole::truncate();

        $role = new UserRole();
        $role->id = User::ROLE_ADMIN_ID;
        $role->name = 'Admin Hệ Thống';
        $role->code = User::ROLE_ADMIN_CODE;
        $role->description = 'Quản trị viên hệ thống có quyền truy cập vào tất cả các khu vực của hệ thống.';
        $role->is_system  = 1;
        $role->sort_order = 1;
        $role->save();

        $role = new UserRole();
        $role->id = User::ROLE_CUSTOMER_ID;
        $role->name = 'Khách Hàng';
        $role->code = User::ROLE_CUSTOMER_CODE;
        $role->description = 'Thành viên đã đăng ký của nền tảng Web';
        $role->sort_order = 2;
        $role->save();
    }
}
