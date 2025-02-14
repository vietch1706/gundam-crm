<?php namespace Gundam\Product\Controllers;

use Backend\Behaviors\FormController;
use Backend\Behaviors\ListController;
use Backend\Behaviors\RelationController;
use Backend\Classes\Controller;
use BackendMenu;

class Product extends Controller
{
    public $implement = [
        FormController::class,
        ListController::class,
        RelationController::class,
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $relationConfig = 'config_relation.yaml';


    public function __construct()
    {
        parent::__construct();
        switch ($this->action) {
            case 'create':
                $this->pageTitle = 'Thêm Sản Phẩm';
                break;
            case 'update':
                $this->pageTitle = 'Chỉnh Sửa Sản Phẩm';
                break;
            case 'preview':
                $this->pageTitle = 'Xem Trước Sản Phẩm';
                break;
            default:
                $this->pageTitle = 'Sản Phẩm';
                break;
        }
        BackendMenu::setContext('Gundam.Product', 'product', 'product-product');
    }
}
