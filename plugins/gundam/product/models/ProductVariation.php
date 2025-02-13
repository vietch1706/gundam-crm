<?php namespace Gundam\Product\Models;

use Model;
use October\Rain\Database\Traits\SoftDelete;
use October\Rain\Database\Traits\Validation;

/**
 * Model
 */
class ProductVariation extends Model
{
    use Validation;
    use SoftDelete;

    /**
     * @var string table in the database used by the model.
     */
    public $table = 'gundam_product_product_variant';
    /**
     * @var array rules for validation.
     */
    public $rules = [
        'name' => 'required',
        'price' => 'required|numeric|gt:0',
        'quantity' => 'required|numeric',
    ];
    public $fillable = [
        'name',
        'price',
    ];
    public $attributes = [
        'quantity' => 0,
        'product_id' => 2,
    ];
    public $belongsTo = [
        'product' => [
            Product::class,
            'key' => 'product_id',
        ]
    ];
    /**
     * @var array dates to cast from the database.
     */
    protected $dates = ['deleted_at'];

}
