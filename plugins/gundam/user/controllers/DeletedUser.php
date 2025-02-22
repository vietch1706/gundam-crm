<?php namespace Gundam\User\Controllers;

use Backend;
use BackendMenu;
use Backend\Classes\Controller;

class DeletedUser extends Controller
{
    public $implement = [
        \Backend\Behaviors\ListController::class
    ];

    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();
        switch ($this->action) {
            case 'create':
                $this->pageTitle = 'Thêm Người Chặn';
                break;
            case 'update':
                $this->pageTitle = 'Chỉnh Sửa Người Chặn';
                break;
            case 'preview':
                $this->pageTitle = 'Xem Trước Người Chặn';
                break;
            default:
                $this->pageTitle = 'Người Chặn';
                break;
        }
        BackendMenu::setContext('Gundam.User', 'users', 'users-deleted');
    }

}
