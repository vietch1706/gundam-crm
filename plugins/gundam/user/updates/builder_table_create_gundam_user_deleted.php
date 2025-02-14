<?php namespace Gundam\User\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGundamUserDeleted extends Migration
{
    public function up()
    {
        Schema::create('gundam_user_deleted', function($table)
        {
            $table->increments('id')->unsigned();
            $table->integer('user_id');
            $table->string('reason')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('gundam_user_deleted');
    }
}
