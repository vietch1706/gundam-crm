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
