<?php namespace Gundam\Auditlog\Controllers;

use Backend;
use BackendMenu;
use Backend\Classes\Controller;

class AuditLog extends Controller
{
    public $implement = [
        \Backend\Behaviors\ListController::class
    ];

    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Gundam.Auditlog', 'logs', 'logs-auditlog');
    }

}
