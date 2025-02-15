<?php namespace Gundam\Blog\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class BuilderTableCreateGundamBlogBlog extends Migration
{
    public function up()
    {
        Schema::create('gundam_blog_blog', function ($table) {
            $table->increments('id')->unsigned();
            $table->string('title', 100);
            $table->string('slug', 100)->unique();
            $table->integer('author_id')->unsigned();
            $table->tinyInteger('category_id')->unsigned();
            $table->longText('content');
            $table->boolean('status')->default(0);
            $table->string('thumbnail')->nullable();
            $table->integer('view')->default(0);
            $table->dateTime('published_at');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->foreign('author_id')
                ->references('id')
                ->on('backend_users')
                ->onDelete('cascade');
            $table->foreign('category_id')
                ->references('id')
                ->on('gundam_blog_category')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('gundam_blog_blog');
    }
}
