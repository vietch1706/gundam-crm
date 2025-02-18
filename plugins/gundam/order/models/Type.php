<?php namespace Gundam\Order\Models;

use Model;

/**
 * Model
 */
class Type extends Model
{
    use \October\Rain\Database\Traits\Validation;

    const STATUS_SUSPENDED = 0;
    const STATUS_ACTIVATE = 1;

    /**
     * @var string table in the database used by the model.
     */
    public $table = 'gundam_order_type_bank';

    /**
     * @var array rules for validation.
     */
    public $rules = [
    ];

    public function getStatusOptions()
    {
        return [
            self::STATUS_ACTIVATE => 'Hoạt Động',
            self::STATUS_SUSPENDED => 'Tạm Dừng',
        ];
    }

    public static function getType()
    {
        $data = [];
        $result = self::where('status', self::STATUS_ACTIVATE)->get();
        foreach ($result as $item) {
            $data[$item->id] = $item->name;
        }
        return $data;
    }

}
