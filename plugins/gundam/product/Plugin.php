<?php namespace Gundam\Product;

use Gundam\Product\Components\ProductDetail;
use Gundam\Product\components\ProductList;
use Gundam\Product\Models\Setting;
use System\Classes\PluginBase;

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

    /**
     * boot method, called right before the request route.
     */
    public function boot()
    {
    }

    /**
     * registerComponents used by the frontend.
     */
    public function registerComponents()
    {
        return [
            ProductList::class => 'productList',
            ProductDetail::class => 'productDetail',
        ];
    }

    /**
     * registerSettings used by the backend.
     */
    public function registerSettings()
    {
        return [
            'settings' => [
                'label' => 'Cài đặt ngày giới hạn mua hàng',
                'description' => 'Giới hạn mua sản phẩm trên ngày',
                'category' => 'CATEGORY_BACKEND',
                'icon' => 'icon-cog',
                'class' => Setting::class,
            ]
        ];
    }
}
