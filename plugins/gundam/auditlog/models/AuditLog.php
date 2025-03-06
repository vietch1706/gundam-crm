<?php namespace Gundam\Auditlog\Models;

use Gundam\User\Models\User;
use Model;

/**
 * Model
 */
class AuditLog extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string table in the database used by the model.
     */
    public $table = 'gundam_auditlog_entity';

    /**
     * @var array rules for validation.
     */
    public $rules = [
    ];

    protected $fillable = ['user_id', 'action', 'model_type', 'model_id', 'old_data', 'new_data'];

    protected $casts = [
        'old_data' => 'array',
        'new_data' => 'array',
    ];

    public $belongsTo = [
        'user' => User::class
    ];

}
