<?php namespace Gundam\Order\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGundamOrderEntity extends Migration
{
    public function up()
    {
        Schema::create('gundam_order_entity', function($table)
        {
            $table->increments('id')->unsigned();
            $table->integer('user_id');
            $table->integer('campaign_id');
            $table->double('total_price', 10, 2);
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->integer('status');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('gundam_order_entity');
    }
}
