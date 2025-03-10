<?php namespace Gundam\Blog\Models;

use Backend\Models\User;
use BackendAuth;
use Model;
use October\Rain\Database\Traits\Validation;
use function array_merge;
use function extract;

/**
 * Model
 */
class Blog extends Model
{
    use Validation;

    public const STATUS_DRAFT = 0;
    public const STATUS_PUBLISHED = 1;
    public const PAGE_DEFAULT = 1;
    public const PER_PAGE = 10;
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
    public $attributes = [
        'status' => self::STATUS_DRAFT,
        'view' => 0,
    ];
    public $belongsTo = [
        'author' => [
            User::class,
            'key' => 'author_id',
        ],
        'category' => [
            Category::class,
            'key' => 'category_id',
        ],
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

    public static function getCategory()
    {
        $result = [];
        $data = Category::all();
        foreach ($data as $item) {
            $result[$item->id] = $item->name;
        }
        return $result;
    }

    public function getStatusOptions()
    {
        return [
            self::STATUS_DRAFT => 'Bản nháp',
            self::STATUS_PUBLISHED => 'Đã xuất bản',
        ];
    }

    public function scopeListBlog($query, $options = [])
    {
        extract(array_merge([
            'page' => self::PAGE_DEFAULT,
            'perPage' => self::PER_PAGE,
            'category' => null,
        ], $options));


        return $query->paginate($perPage, $page);
    }

    protected function beforeSave()
    {
        $this->author_id = BackendAuth::getUser()->id;
    }
}
