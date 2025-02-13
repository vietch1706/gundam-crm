<?php namespace Gundam\Order\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGundamOrderBankAccount extends Migration
{
    public function up()
    {
        Schema::create('gundam_order_bank_account', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('account_number');
            $table->string('account_name');
            $table->integer('type_id');
            $table->text('image');
            $table->integer('status')->default(0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gundam_order_bank_account');
    }
}
