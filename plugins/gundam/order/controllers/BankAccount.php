<?php namespace Gundam\Order\Controllers;

use Backend;
use BackendMenu;
use Backend\Classes\Controller;

class BankAccount extends Controller
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
                $this->pageTitle = 'Thêm Tài Khoản';
                break;
            case 'update':
                $this->pageTitle = 'Chỉnh Sửa Tài Khoản';
                break;
            case 'preview':
                $this->pageTitle = 'Xem Trước Tài Khoản';
                break;
            default:
                $this->pageTitle = 'Tài Khoản';
                break;
        }
        BackendMenu::setContext('Gundam.Order', 'bank', 'bank-account');
    }

}
