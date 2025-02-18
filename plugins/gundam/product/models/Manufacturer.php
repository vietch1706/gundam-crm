<?php namespace Gundam\Product\Models;

use Model;
use October\Rain\Database\Traits\SoftDelete;
use October\Rain\Database\Traits\Validation;

/**
 * Model
 */
class Manufacturer extends Model
{
    use Validation;
    use SoftDelete;

    /**
     * @var string table in the database used by the model.
     */
    public $table = 'gundam_product_manufacturer';
    /**
     * @var array rules for validation.
     */
    public $rules = [
    ];
    /**
     * @var array dates to cast from the database.
     */
    protected $dates = ['deleted_at'];

}
