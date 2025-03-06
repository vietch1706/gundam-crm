<?php namespace Gundam\Order\Controllers;

use Backend;
use BackendMenu;
use Backend\Classes\Controller;

class Order extends Controller
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
        BackendMenu::setContext('Gundam.Order', 'order', 'order-order');
    }

    public function onUpdateTotalPrice()
    {
        $data = post('Order');

        $total = 0;
        if (isset($data['detail']) && is_array($data['detail'])) {
            foreach ($data['detail'] as $index => $item) {
                if (isset($item['product']) && isset($item['quantity'])) {
                    $product = \YourVendor\Products\Models\Product::find($item['product']);
                    if ($product) {
                        $price = $product->price;
                        $quantity = intval($item['quantity']);
                        $total += $price * $quantity;

                        // Cập nhật giá sản phẩm trong repeater
                        $data['detail'][$index]['price'] = $price;
                    }
                }
            }
        }

        // Trả về tổng tiền cập nhật
        return [
            '#Form-field-Order-total_price' => $total,
            '#Form-field-Order-detail' => $data['detail']
        ];
    }

}
