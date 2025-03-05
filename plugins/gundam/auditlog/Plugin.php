<?php namespace Gundam\Auditlog;

use System\Classes\PluginBase;
use BackendAuth;
use Gundam\Auditlog\Models\AuditLog;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Log;

/**
 * Plugin class
 */
class Plugin extends PluginBase
{
    /**
     * register method, called when the plugin is first registered.
     */
    public function register()
    {
    }

    public function boot()
    {
        \Event::listen('eloquent.created: Gundam\Blog\Models\Category', function ($model) {
            $this->logAction($model, 'create');
        });
        \Event::listen('eloquent.updated: Gundam\Blog\Models\Category', function ($model) {
            $this->logAction($model, 'update');
        });
        \Event::listen('eloquent.deleted: Gundam\Blog\Models\Category', function ($model) {
            $this->logAction($model, 'delete');
        });

        \Event::listen('eloquent.created: Gundam\Blog\Models\Blog', function ($model) {
            $this->logAction($model, 'create');
        });
        \Event::listen('eloquent.updated: Gundam\Blog\Models\Blog', function ($model) {
            $this->logAction($model, 'update');
        });
        \Event::listen('eloquent.deleted: Gundam\Blog\Models\Blog', function ($model) {
            $this->logAction($model, 'delete');
        });

        \Event::listen('eloquent.created: Gundam\General\Models\District', function ($model) {
            $this->logAction($model, 'create');
        });
        \Event::listen('eloquent.updated: Gundam\General\Models\District', function ($model) {
            $this->logAction($model, 'update');
        });
        \Event::listen('eloquent.deleted: Gundam\General\Models\District', function ($model) {
            $this->logAction($model, 'delete');
        });

        \Event::listen('eloquent.created: Gundam\General\Models\Province', function ($model) {
            $this->logAction($model, 'create');
        });
        \Event::listen('eloquent.updated: Gundam\General\Models\Province', function ($model) {
            $this->logAction($model, 'update');
        });
        \Event::listen('eloquent.deleted: Gundam\General\Models\Province', function ($model) {
            $this->logAction($model, 'delete');
        });

        \Event::listen('eloquent.created: Gundam\General\Models\Ward', function ($model) {
            $this->logAction($model, 'create');
        });
        \Event::listen('eloquent.updated: Gundam\General\Models\Ward', function ($model) {
            $this->logAction($model, 'update');
        });
        \Event::listen('eloquent.deleted: Gundam\General\Models\Ward', function ($model) {
            $this->logAction($model, 'delete');
        });

        \Event::listen('eloquent.created: Gundam\Order\Models\Type', function ($model) {
            $this->logAction($model, 'create');
        });
        \Event::listen('eloquent.updated: Gundam\Order\Models\Type', function ($model) {
            $this->logAction($model, 'update');
        });
        \Event::listen('eloquent.deleted: Gundam\Order\Models\Type', function ($model) {
            $this->logAction($model, 'delete');
        });

        \Event::listen('eloquent.created: Gundam\Order\Models\BankAccount', function ($model) {
            $this->logAction($model, 'create');
        });
        \Event::listen('eloquent.updated: Gundam\Order\Models\BankAccount', function ($model) {
            $this->logAction($model, 'update');
        });
        \Event::listen('eloquent.deleted: Gundam\Order\Models\BankAccount', function ($model) {
            $this->logAction($model, 'delete');
        });

        \Event::listen('eloquent.created: Gundam\Product\Models\Category', function ($model) {
            $this->logAction($model, 'create');
        });
        \Event::listen('eloquent.updated: Gundam\Product\Models\Category', function ($model) {
            $this->logAction($model, 'update');
        });
        \Event::listen('eloquent.deleted: Gundam\Product\Models\Category', function ($model) {
            $this->logAction($model, 'delete');
        });

        \Event::listen('eloquent.created: Gundam\Product\Models\Manufacturer', function ($model) {
            $this->logAction($model, 'create');
        });
        \Event::listen('eloquent.updated: Gundam\Product\Models\Manufacturer', function ($model) {
            $this->logAction($model, 'update');
        });
        \Event::listen('eloquent.deleted: Gundam\Product\Models\Manufacturer', function ($model) {
            $this->logAction($model, 'delete');
        });

        \Event::listen('eloquent.created: Gundam\Product\Models\Product', function ($model) {
            $this->logAction($model, 'create');
        });
        \Event::listen('eloquent.updated: Gundam\Product\Models\Product', function ($model) {
            $this->logAction($model, 'update');
        });
        \Event::listen('eloquent.deleted: Gundam\Product\Models\Product', function ($model) {
            $this->logAction($model, 'delete');
        });

        \Event::listen('eloquent.created: Gundam\Product\Models\ProductVariation', function ($model) {
            $this->logAction($model, 'create');
        });
        \Event::listen('eloquent.updated: Gundam\Product\Models\ProductVariation', function ($model) {
            $this->logAction($model, 'update');
        });
        \Event::listen('eloquent.deleted: Gundam\Product\Models\ProductVariation', function ($model) {
            $this->logAction($model, 'delete');
        });

        \Event::listen('eloquent.created: Gundam\User\Models\DeletedUser', function ($model) {
            $this->logAction($model, 'create');
        });
        \Event::listen('eloquent.updated: Gundam\User\Models\DeletedUser', function ($model) {
            $this->logAction($model, 'update');
        });
        \Event::listen('eloquent.deleted: Gundam\User\Models\DeletedUser', function ($model) {
            $this->logAction($model, 'delete');
        });

        \Event::listen('eloquent.created: Gundam\User\Models\User', function ($model) {
            $this->logAction($model, 'create');
        });
        \Event::listen('eloquent.updated: Gundam\User\Models\User', function ($model) {
            $this->logAction($model, 'update');
        });
        \Event::listen('eloquent.deleted: Gundam\User\Models\User', function ($model) {
            $this->logAction($model, 'delete');
        });
    }

    /**
     * registerComponents used by the frontend.
     */
    public function registerComponents()
    {
    }

    /**
     * registerSettings used by the backend.
     */
    public function registerSettings()
    {
    }

    protected function logAction($model, $action)
    {
        $user = BackendAuth::getUser();

        AuditLog::create([
            'user_id' => $user ? $user->id : null,
            'action' => $action,
            'model_type' => get_class($model),
            'model_id' => $model->id ?? null,
            'old_data' => $action === 'update' ? $model->getOriginal() : null,
            'new_data' => $action !== 'delete' ? $model->toArray() : null,
        ]);
    }
}
