<?php

namespace Gundam\Product\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class BuilderTableCreateGundamProductManufacturer extends Migration
{
    public function up()
    {
        Schema::create('gundam_product_manufacturer', function ($table) {
            $table->tinyIncrements('id')->unsigned();
            $table->string('name', 100);
            $table->string('slug', 100)->unique();
            $table->string('country', 100);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gundam_product_manufacturer');
    }
}
