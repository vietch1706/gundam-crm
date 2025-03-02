<?php namespace Gundam\Order\Models;

use Gundam\User\Models\User;
use Illuminate\Support\Facades\DB;
use Model;

/**
 * Model
 */
class Order extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string table in the database used by the model.
     */
    public $table = 'gundam_order_entity';

    /**
     * @var array rules for validation.
     */
    public $rules = [
    ];

    public $belongsTo = [
        'user' => [User::class],
    ];

    public $hasMany = [
        'detail' => [
            Detail::class,
        ]
    ];

    public function getUserIdOptions()
    {
        $data = User::all();
        $result = [];
        foreach ($data as $key => $value) {
            $result[$value->id] = $value->fist_name . ' ' . $value->last_name;
        }
        return $result;
    }

    public function getCampaignIdOptions()
    {
        return [];
    }

//    public function order($userId, $products)
//    {
//        DB::beginTransaction();
//        try {
//            // 1️⃣ Tạo đơn hàng (chưa hoàn tất)
//            $order_id = DB::table('orders')->insertGetId([
//                'user_id' => $userId,
//                'status' => 'pending',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ]);
//
//            foreach ($products as $p) {
//                // 2️⃣ Kiểm tra sản phẩm và khóa dòng đó
//                $product = DB::table('products')
//                    ->where('id', $p['product_id'])
//                    ->lockForUpdate()
//                    ->first();
//
//                if (!$product || $product->stock < $p['quantity']) {
//                    throw new \Exception("Sản phẩm {$p['product_id']} không đủ hàng.");
//                }
//
//                // 3️⃣ Trừ stock an toàn với where kiểm tra số lượng
//                $updated = DB::table('products')
//                    ->where('id', $p['product_id'])
//                    ->where('stock', '>=', $p['quantity'])
//                    ->decrement('stock', $p['quantity']);
//
//                if (!$updated) {
//                    throw new \Exception("Sản phẩm {$p['product_id']} đã hết hàng trong quá trình đặt.");
//                }
//
//                // 4️⃣ Thêm chi tiết đơn hàng
//                DB::table('order_items')->insert([
//                    'order_id' => $order_id,
//                    'product_id' => $p['product_id'],
//                    'quantity' => $p['quantity'],
//                    'price' => $p['price'],
//                    'created_at' => now(),
//                    'updated_at' => now(),
//                ]);
//            }
//
//            // 5️⃣ Cập nhật trạng thái đơn hàng hoàn tất
//            DB::table('orders')
//                ->where('id', $order_id)
//                ->update(['status' => 'completed', 'updated_at' => now()]);
//
//            DB::commit();
//        } catch (\Exception $e) {
//            DB::rollBack();
//            throw $e;
//        }
//    }

}
