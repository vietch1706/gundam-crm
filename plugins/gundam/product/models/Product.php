<?php namespace Gundam\Product\Models;

use Model;
use October\Rain\Database\Traits\SoftDelete;
use October\Rain\Database\Traits\Validation;

/**
 * Model
 */
class Product extends Model
{
    use Validation;
    use SoftDelete;

    public const MATERIAL_PLASTIC = 0;
    public const MATERIAL_ALLOY = 1;

    public const TYPE_SINGLE = 0;
    public const TYPE_MULTI = 1;

    public const IS_LIMIT_YES = 1;
    public const IS_LIMIT_NO = 0;

    /**
     * @var string table in the database used by the model.
     */
    public $table = 'gundam_product_product';
    public $rules = [
        'name' => 'required',
        'slug' => 'required|unique:gundam_product_product,slug',
        'sku' => 'required|unique:gundam_product_product,sku',
        'price' => 'required|numeric|gt:0',
        'quantity' => 'required|numeric|min:0',
        'category_id' => 'required',
        'manufacturer_id' => 'required',
        'type' => 'required',
        'weight' => 'required|numeric|gt:0',
        'thumbnail' => 'required|string',
        'gallery' => 'required|array|min:1',
        'gallery.*' => 'string',
    ];

    public $attributes = [
        'material' => self::MATERIAL_PLASTIC,
        'type' => self::TYPE_SINGLE,
        'quantity' => 0,
    ];
    public $belongsTo = [
        'category' => [
            Category::class,
            'key' => 'category_id',
        ],
        'manufacturer' => [
            Manufacturer::class,
            'key' => 'manufacturer_id',
        ]
    ];
    public $hasMany = [
        'product_variants' => [
            ProductVariation::class,
            'key' => 'product_id',
        ]
    ];
    protected $jsonable = [
        'gallery',
    ];
    /**
     * @var array rules for validation.
     */
    protected $fillable = [
        'name',
        'slug',
        'sku',
        'price',
        'category_id',
        'manufacturer_id',
        'material',
        'weight',
        'type',
        'thumbnail',
        'gallery',
        'description',
        'character',
        'size'
    ];
    /**
     * @var array dates to cast from the database.
     */
    protected $dates = [
        'deleted_at'
    ];

    public function scopeListProduct($query, $options = [])
    {
        extract(array_merge([
            'page' => 1,
            'perPage' => 2,
            'price' => null,
        ], $options));

        if ($price !== null) {
            if (is_array($price)) {
                $minPrice = $price['min'] ?? null;
                $maxPrice = $price['max'] ?? null;

                if ($minPrice !== null) {
                    $query->where('price', '>=', $minPrice);
                }

                if ($maxPrice !== null) {
                    $query->where('price', '<=', $maxPrice);
                }
            } else {
                $query->where('price', '=', $price);
            }
        }

        return $query->paginate($perPage, ['*'], 'page', $page);
    }

    public function getMaterialOptions()
    {
        return [
            self::MATERIAL_PLASTIC => 'Nhựa',
            self::MATERIAL_ALLOY => 'Hợp kim, Cao su',
        ];
    }

    public function getTypeOptions()
    {
        return [
            self::TYPE_SINGLE => 'Đơn',
            self::TYPE_MULTI => 'Đa',
        ];
    }

    public function getIsLimitOptions()
    {
        return [
            self::IS_LIMIT_YES => 'Có',
            self::IS_LIMIT_NO => 'Không'
        ];
    }

    public static function getCategory()
    {
        $result = [];
        $data = Category::all();
        foreach ($data as $item) {
            $result[$item->id] = $item->name;
        }
        return $result;
    }

    public static function getManufacturer()
    {
        $result = [];
        $data = Manufacturer::all();
        foreach ($data as $item) {
            $result[$item->id] = $item->name;
        }
        return $result;
    }
}
