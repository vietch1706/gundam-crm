<?php namespace Gundam\User\Controllers;

use Backend;
use BackendMenu;
use Backend\Classes\Controller;
use Gundam\General\Models\District;
use Gundam\General\Models\Ward;
use October\Rain\Exception\ApplicationException;

class User extends Controller
{
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();
        switch ($this->action) {
            case 'create':
                $this->pageTitle = 'Thêm Người Dùng';
                break;
            case 'update':
                $this->pageTitle = 'Chỉnh Sửa Người Dùng';
                break;
            case 'preview':
                $this->pageTitle = 'Xem Trước Người Dùng';
                break;
            default:
                $this->pageTitle = 'Người Dùng';
                break;
        }
        BackendMenu::setContext('Gundam.User', 'users', 'users-user');
    }

    public function onUpdateDistricts()
    {
        $provinceId = post('province_id');
        return District::getDistrictByProvince($provinceId);
    }

    public function onUpdateWards()
    {
        $districtId = post('district_id');

        return Ward::getWardByDistrict($districtId);
    }

    public function listExtendQuery($query)
    {
        $query->where('role_id', \Gundam\User\Models\User::ROLE_CUSTOMER_ID);
    }

    public function onDeleteUser()
    {
        $userId = array_map('intval', post('user_ids'));
        $reason = post('reason');

        if (!$userId || !$reason) {
            throw new ApplicationException('Vui lòng nhập lý do xóa.');
        }


        foreach ($userId as $id) {
            $deletedUser = new \Gundam\User\Models\DeletedUser();
            $deletedUser->user_id = $id;
            $deletedUser->reason = $reason;
            $deletedUser->save();

            \Gundam\User\Models\User::find($id)->delete();
        }

        \Flash::success('User đã bị xóa thành công!');
    }
}
