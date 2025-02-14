<?php namespace Gundam\User\Models;

use Model;

/**
 * Model
 */
class DeletedUser extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string table in the database used by the model.
     */
    public $table = 'gundam_user_deleted';

    /**
     * @var array rules for validation.
     */
    public $rules = [
    ];

    public $belongsTo = [
        'user' => [User::class, 'key' => 'user_id', 'scope' => 'withTrashed']
    ];

}
