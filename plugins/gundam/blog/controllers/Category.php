<?php namespace Gundam\Blog\Controllers;

use Backend;
use BackendMenu;
use Backend\Classes\Controller;

class Category extends Controller
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
                $this->pageTitle = 'Thêm Thể Loại';
                break;
            case 'update':
                $this->pageTitle = 'Chỉnh Sửa Thể Loại';
                break;
            case 'preview':
                $this->pageTitle = 'Xem Trước Thể Loại';
                break;
            default:
                $this->pageTitle = 'Thể Loại';
                break;
        }
        BackendMenu::setContext('Gundam.Blog', 'blog', 'blog-category');
    }

}
