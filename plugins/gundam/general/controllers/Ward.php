<?php namespace Gundam\General\Controllers;

use Backend;
use BackendMenu;
use Backend\Classes\Controller;

class Ward extends Controller
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
                $this->pageTitle = 'Thêm Xã';
                break;
            case 'update':
                $this->pageTitle = 'Chỉnh Sửa Xã';
                break;
            case 'preview':
                $this->pageTitle = 'Xem Trước Xã';
                break;
            default:
                $this->pageTitle = 'Xã';
                break;
        }
        BackendMenu::setContext('Gundam.General', 'general', 'general-ward');
    }

}
