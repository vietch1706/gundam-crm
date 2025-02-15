<?php namespace Gundam\Product\Controllers;

use Backend\Behaviors\FormController;
use Backend\Behaviors\ListController;
use Backend\Classes\Controller;
use BackendMenu;

class Manufacturer extends Controller
{
    public $implement = [
        FormController::class,
        ListController::class
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();
        switch ($this->action) {
            case 'create':
                $this->pageTitle = 'Thêm Nhà Sản Xuất';
                break;
            case 'update':
                $this->pageTitle = 'Chỉnh Sửa Nhà Sản Xuất';
                break;
            case 'preview':
                $this->pageTitle = 'Xem Trước Nhà Sản Xuất';
                break;
            default:
                $this->pageTitle = 'Nhà Sản Xuất';
                break;
        }
        BackendMenu::setContext('Gundam.Product', 'product', 'product-manufacturer');
    }

}
