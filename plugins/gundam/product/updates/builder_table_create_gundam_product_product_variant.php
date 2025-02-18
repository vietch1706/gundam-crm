<?php

namespace Gundam\Product\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class BuilderTableCreateGundamProductProductVariant extends Migration
{
    public function up()
    {
        Schema::create('gundam_product_product_variant', function ($table) {
            $table->increments('id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->string('name', 100);
            $table->decimal('price', 15, 2)->unsigned();
            $table->smallInteger('quantity')->unsigned();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->foreign('product_id')
                ->references('id')
                ->on('gundam_product_product')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('gundam_product_product_variant');
    }
}
