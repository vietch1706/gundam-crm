<?php namespace Gundam\General\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGundamGeneralProvince extends Migration
{
    public function up()
    {
        Schema::create('gundam_general_province', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('name')->nullable();
            $table->integer('code')->nullable();
            $table->string('codename')->nullable();
            $table->string('phone_code')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gundam_general_province');
    }
}
