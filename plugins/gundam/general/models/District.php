<?php namespace Gundam\General\Models;

use Model;

/**
 * Model
 */
class District extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string table in the database used by the model.
     */
    public $table = 'gundam_general_district';

    /**
     * @var array rules for validation.
     */
    public $rules = [
    ];

    public $belongsTo = [
        'province' => [Province::class, 'key' => 'province_id'],
    ];

    public $hasMany = [
        'wards' => [Ward::class, 'key' => 'district_id'],
    ];

    public static function getProvince()
    {
        $result = [];
        $data = Province::all();
        foreach ($data as $item) {
            $result[$item->id] = $item->name;
        }
        return $result;
    }

    public static function getDistrictByProvince($proviceId)
    {
        $data = District::where('province_id', $proviceId)->get();
        $result = [];
        foreach ($data as $item) {
            $result[$item->id] = $item->name;
        }
        return $result;
    }
}
