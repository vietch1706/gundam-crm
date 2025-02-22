<?php namespace Gundam\Order\Controllers;

use Backend;
use BackendMenu;
use Backend\Classes\Controller;

class Type extends Controller
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
                $this->pageTitle = 'Thêm Ngân Hàng';
                break;
            case 'update':
                $this->pageTitle = 'Chỉnh Sửa Ngân Hàng';
                break;
            case 'preview':
                $this->pageTitle = 'Xem Trước Ngân Hàng';
                break;
            default:
                $this->pageTitle = 'Ngân Hàng';
                break;
        }
        BackendMenu::setContext('Gundam.Order', 'bank', 'bank-type');
    }

}
