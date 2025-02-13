<?php namespace Gundam\Order\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGundamOrderTypeBank extends Migration
{
    public function up()
    {
        Schema::create('gundam_order_type_bank', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('name')->nullable();
            $table->integer('status')->default(0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gundam_order_type_bank');
    }
}
