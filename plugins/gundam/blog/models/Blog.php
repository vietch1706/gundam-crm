<?php namespace Gundam\Blog\Models;

use Backend\Models\User;
use BackendAuth;
use Model;

/**
 * Model
 */
class Blog extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public const STATUS_DRAFT = 0;
    public const STATUS_PUBLISHED = 1;
    /**
     * @var string table in the database used by the model.
     */
    public $table = 'gundam_blog_blog';

    /**
     * @var array rules for validation.
     */
    public $rules = [
        'title' => 'required',
        'slug' => 'required|unique:gundam_blog_blog,slug',
        'content' => 'required',
        'status' => 'required',
        'thumbnail' => 'required|string',
        'published_at' => 'required',
    ];

    protected $fillable = [
        'title',
        'slug',
        'author_id',
        'content',
        'thumbnail',
        'published_at',
    ];
    protected $dates = ['published_at'];
    public $attributes = [
        'status' => self::STATUS_DRAFT,
        'view' => 0,
    ];

    public $belongsTo = [
        'author' => [
            User::class,
            'key' => 'author_id',
        ]
    ];

    protected function beforeSave()
    {
        $this->author_id = BackendAuth::getUser()->id;
    }

    public function getStatusOptions()
    {
        return [
            self::STATUS_DRAFT => 'Bản nháp',
            self::STATUS_PUBLISHED => 'Đã xuất bản',
        ];
    }
}
