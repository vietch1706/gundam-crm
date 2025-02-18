<?php namespace Gundam\Product\Controllers;

use Backend\Behaviors\FormController;
use Backend\Behaviors\ListController;
use Backend\Classes\Controller;
use BackendMenu;

class Category extends Controller
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
                $this->pageTitle = 'Thêm Danh Mục';
                break;
            case 'update':
                $this->pageTitle = 'Chỉnh Sửa Danh Mục';
                break;
            case 'preview':
                $this->pageTitle = 'Xem Trước Danh Mục';
                break;
            default:
                $this->pageTitle = 'Danh Mục';
                break;
        }
        BackendMenu::setContext('Gundam.Product', 'product', 'product-category');
    }

}
