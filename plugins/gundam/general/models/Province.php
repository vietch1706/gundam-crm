<?php namespace Gundam\General\Models;

use Model;

/**
 * Model
 */
class Province extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string table in the database used by the model.
     */
    public $table = 'gundam_general_province';

    /**
     * @var array rules for validation.
     */
    public $rules = [
    ];

    public $hasMany = [
        'districts' => [District::class, 'key' => 'province_id'],
    ];

    public static function getProvince()
    {
        $result = [];
        $data = self::all();

        foreach ($data as $item) {
            $result[$item->id] = $item->name;
        }

        return $result;
    }
}
