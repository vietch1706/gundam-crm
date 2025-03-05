<?php namespace Gundam\General\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGundamGeneral extends Migration
{
    public function up()
    {
        Schema::create('gundam_general_supportive_page', function($table)
        {
            $table->increments('id')->unsigned();
            $table->text('title');
            $table->text('content');
            $table->string('slug');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('gundam_general_');
    }
}
