<?php namespace Gundam\Order\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGundamOrderDetail extends Migration
{
    public function up()
    {
        Schema::create('gundam_order_detail', function($table)
        {
            $table->increments('id')->unsigned();
            $table->integer('order_id');
            $table->integer('product_id');
            $table->double('price', 10, 2);
            $table->integer('total');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('gundam_order_detail');
    }
}
