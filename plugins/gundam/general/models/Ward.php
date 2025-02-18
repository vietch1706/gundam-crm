<?php namespace Gundam\General\Models;

use Model;

/**
 * Model
 */
class Ward extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string table in the database used by the model.
     */
    public $table = 'gundam_general_ward';

    /**
     * @var array rules for validation.
     */
    public $rules = [
    ];

    public $belongsTo = [
        'district' => [District::class, 'key' => 'district_id'],
    ];

    public static function getDistrict()
    {
        $result = [];
        $data = District::all();
        foreach ($data as $item) {
            $result[$item->id] = $item->name;
        }
        return $result;
    }

    public static function getWardByDistrict($districtId)
    {
        $data = Ward::where('district_id', $districtId)->get();
        $result = [];
        foreach ($data as $item) {
            $result[$item->id] = $item->name;
        }
        return $result;
    }
}
