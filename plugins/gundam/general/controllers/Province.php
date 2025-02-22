<?php namespace Gundam\General\Controllers;

use Backend;
use BackendMenu;
use Backend\Classes\Controller;

class Province extends Controller
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
                $this->pageTitle = 'Thêm Tỉnh';
                break;
            case 'update':
                $this->pageTitle = 'Chỉnh Sửa Tỉnh';
                break;
            case 'preview':
                $this->pageTitle = 'Xem Trước Tỉnh';
                break;
            default:
                $this->pageTitle = 'Tỉnh';
                break;
        }
        BackendMenu::setContext('Gundam.General', 'general', 'general-province');
    }

}
