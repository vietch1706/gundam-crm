<?php namespace Gundam\User\Controllers;

use Backend;
use BackendMenu;
use Backend\Classes\Controller;

class DeletedUser extends Controller
{
    public $implement = [
        \Backend\Behaviors\ListController::class
    ];

    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Gundam.User', 'users', 'users-deleted');
    }

}
