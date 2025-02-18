<?php namespace Gundam\Product\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class BuilderTableCreateGundamProductProduct extends Migration
{
    public function up()
    {
        Schema::create('gundam_product_product', function ($table) {
            $table->increments('id')->unsigned();
            $table->string('name', 100);
            $table->string('slug', 100)->unique();
            $table->string('sku')->unique();
            $table->tinyInteger('category_id')->unsigned();
            $table->float('price', 10, 2)->unsigned();
            $table->smallInteger('quantity')->unsigned();
            $table->boolean('material');
            $table->float('weight', 10, 2)->unsigned();
            $table->tinyInteger('manufacturer_id')->unsigned();
            $table->boolean('type');
            $table->string('thumbnail');
            $table->json('gallery');
            $table->string('character');
            $table->longText('description');
            $table->string('size');
            $table->boolean('is_limit');
            $table->integer('limit');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->foreign('category_id')
                ->references('id')
                ->on('gundam_product_category')
                ->onDelete('cascade');
            $table->foreign('manufacturer_id')
                ->references('id')
                ->on('gundam_product_manufacturer')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('gundam_product_product');
    }
}
