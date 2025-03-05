<?php namespace Gundam\Order\Models;

use Gundam\User\Models\User;
use Model;

/**
 * Model
 */
class Order extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string table in the database used by the model.
     */
    public $table = 'gundam_order_entity';

    /**
     * @var array rules for validation.
     */
    public $rules = [
    ];

    public $belongsTo = [
        'user' => [User::class],
    ];

    public $hasMany = [
        'detail' => [
            Detail::class,
        ]
    ];

    public function getUserIdOptions()
    {
        $data = User::all();
        $result = [];
        foreach ($data as $key => $value) {
            $result[$value->id] = $value->fist_name . ' ' . $value->last_name;
        }
        return $result;
    }

    public function getCampaignIdOptions()
    {
        return [];
    }
}
