<?php

namespace Gundam\Product\Models;

use System\Models\SettingModel;

class Setting extends SettingModel
{
    use \October\Rain\Database\Traits\Validation;

    public $settingsCode = 'skechers_reward_setting';

    public $settingsFields = 'fields.yaml';

    public $rules = [
        'limit_date' => 'required'
    ];
}
