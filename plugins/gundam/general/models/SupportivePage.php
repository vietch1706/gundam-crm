<?php namespace Gundam\General\Models;

use Model;

/**
 * Model
 */
class SupportivePage extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string table in the database used by the model.
     */
    public $table = 'gundam_general_supportive_page';

    /**
     * @var array rules for validation.
     */
    public $rules = [
        'title' => 'required',
        'content' => 'required',
        'slug' => 'required',
    ];

    protected $fillable = ['title', 'content', 'slug'];

}
