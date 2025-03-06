<?php namespace Gundam\Order\Models;

use Gundam\Product\Models\Product;
use Model;

/**
 * Model
 */
class Detail extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string table in the database used by the model.
     */
    public $table = 'gundam_order_detail';

    /**
     * @var array rules for validation.
     */
    public $rules = [
    ];

    public $belongsTo = [
        'product' => [
            Product::class,
        ],
        'order' => [
            Order::class,
        ]
    ];
}
