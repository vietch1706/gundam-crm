<?php

namespace Gundam\User\Models;

use Gundam\General\Models\District;
use Gundam\General\Models\Province;
use Gundam\General\Models\Ward;

class User extends \Backend\Models\User
{
    const ROLE_ADMIN_CODE = 'admin';
    const ROLE_CUSTOMER_CODE = 'customer';

    const ROLE_ADMIN_ID = '1';
    const ROLE_CUSTOMER_ID = '2';

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const IS_ACTIVE_YES = 1;
    const IS_ACTIVE_NO = 0;

    protected $table = 'backend_users';

    public $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => [
            'required',
            'email',
            'unique:backend_users,email'
        ],
        'is_activated' => 'required',
        'phone' => [
            'required',
            'regex:/^(03[2-9]|05[2-9]|07[0-9]|08[1-9]|09[0-9])\d{7}$/',
            'unique:backend_users,phone'
        ],
        'link_facebook' => [
            'required',
            'regex:/^(https?:\/\/)?(www\.)?(facebook\.com|fb\.com)\/[a-zA-Z0-9\.]+\/?$/',
            'unique:backend_users,link_facebook'
        ],
        'status' => 'required',
        'province_id' => 'required',
        'district_id' => 'required',
        'ward_id' => 'required',
        'address' => 'required',
    ];

    public function beforeValidate()
    {
        if (empty($this->login)) {
            $this->login = $this->email;
        }
    }

    public function beforeCreate()
    {
        if (empty($this->role_id)) {
            $this->role_id = self::ROLE_CUSTOMER_ID;
        }
    }

    public function beforeDelete(){

    }

    public function getIsActivatedOptions()
    {
        return [
            self::IS_ACTIVE_YES => 'Có',
            self::IS_ACTIVE_NO => 'Không',
        ];
    }

    public function getStatusOptions()
    {
        return [
            self::STATUS_ACTIVE => 'Hoạt Động',
            self::STATUS_INACTIVE => 'Đình Chỉ'
        ];
    }

    public function getProvinceIdOptions()
    {
        return Province::getProvince();
    }

    public function getDistrictIdOptions()
    {
        return District::getDistrictByProvince($this->province_id);
    }

    public function getWardIdOptions()
    {
        return Ward::getWardByDistrict($this->district_id);
    }
}
