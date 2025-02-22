<?php namespace Gundam\Auditlog\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGundamAuditlogEntity extends Migration
{
    public function up()
    {
        Schema::create('gundam_auditlog_entity', function ($table) {
            $table->increments('id')->unsigned();
            $table->unsignedBigInteger('user_id')->nullable(); // ID của người dùng thực hiện hành động
            $table->string('action'); // Hành động (create, update, delete,...)
            $table->string('model_type')->nullable(); // Loại model bị ảnh hưởng
            $table->unsignedBigInteger('model_id')->nullable(); // ID của bản ghi bị ảnh hưởng
            $table->json('old_data')->nullable(); // Dữ liệu trước khi thay đổi
            $table->json('new_data')->nullable(); // Dữ liệu sau khi thay đổi
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gundam_auditlog_entity');
    }
}
