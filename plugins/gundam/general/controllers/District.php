<?php namespace Gundam\General\Controllers;

use Backend;
use BackendMenu;
use Backend\Classes\Controller;

class District extends Controller
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
                $this->pageTitle = 'Thêm Huyện';
                break;
            case 'update':
                $this->pageTitle = 'Chỉnh Sửa Huyện';
                break;
            case 'preview':
                $this->pageTitle = 'Xem Trước Huyện';
                break;
            default:
                $this->pageTitle = 'Huyện';
                break;
        }
        BackendMenu::setContext('Gundam.General', 'general', 'general-district');
    }

}
