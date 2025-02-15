<?php namespace Gundam\Blog\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGundamBlogCategory extends Migration
{
    public function up()
    {
        Schema::create('gundam_blog_category', function ($table) {
            $table->tinyIncrements('id')->unsigned();
            $table->string('name', 100);
            $table->string('slug', 100)->unique();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gundam_blog_category');
    }
}
