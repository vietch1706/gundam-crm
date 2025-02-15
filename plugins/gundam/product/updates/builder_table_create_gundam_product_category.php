<?php namespace Gundam\Product\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class BuilderTableCreateGundamProductCategory extends Migration
{
    public function up()
    {
        Schema::create('gundam_product_category', function ($table) {
            $table->tinyIncrements('id')->unsigned();
            $table->string('name', 100);
            $table->string('slug', 100)->unique();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gundam_product_category');
    }
}
