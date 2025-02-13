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
        BackendMenu::setContext('Gundam.Product', 'product', 'product-category');
    }

    public function formExtendFields($form)
    {
        $model = $form->model;
        $context = $this->formGetContext();

        $model->readOnlyMode = ($context === 'update');
    }
}
