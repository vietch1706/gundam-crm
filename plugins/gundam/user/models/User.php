<?php

namespace Gundam\User\Models;

class User extends \Backend\Models\User
{
    const ROLE_ADMIN_CODE = 'admin';
    const ROLE_CUSTOMER_CODE = 'customer';

    const ROLE_ADMIN_ID = '1';
    const ROLE_CUSTOMER_ID = '2';

    protected $table = 'backend_users';
}
