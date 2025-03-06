<?php namespace Gundam\Blog\Controllers;

use Backend\Classes\Controller;
use BackendAuth;
use BackendMenu;

class Blog extends Controller
{
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();
        switch ($this->action) {
            case 'create':
                $this->pageTitle = 'Thêm Tin Tức';
                break;
            case 'update':
                $this->pageTitle = 'Chỉnh Sửa Tin Tức';
                break;
            case 'preview':
                $this->pageTitle = 'Xem Trước Tin Tức';
                break;
            default:
                $this->pageTitle = 'Tin Tức';
                break;
        }
        BackendMenu::setContext('Gundam.Blog', 'blog', 'blog-blog');
    }

    public function formExtendFields($form)
    {
        $user = BackendAuth::getUser();
        if ($user) {
            $form->getField('author_id')->value = $user->first_name . ' ' . $user->last_name;
        }
    }
}
