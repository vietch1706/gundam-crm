<?php namespace Gundam\Order\Models;

use Model;

/**
 * Model
 */
class BankAccount extends Model
{
    use \October\Rain\Database\Traits\Validation;

    const STATUS_SUSPENDED = 0;
    const STATUS_ACTIVATE = 1;

    /**
     * @var string table in the database used by the model.
     */
    public $table = 'gundam_order_bank_account';

    /**
     * @var array rules for validation.
     */
    public $rules = [
    ];

    public $belongsTo = [
        'type' => [Type::class, 'key' => 'type_id']
    ];

    public function getStatusOptions()
    {
        return [
            self::STATUS_ACTIVATE => 'Hoạt Động',
            self::STATUS_SUSPENDED => 'Tạm Dừng',
        ];
    }

    public function getTypeIdOptions()
    {
        return Type::getType();
    }
}
