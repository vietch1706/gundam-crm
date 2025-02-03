<?php

namespace Skechers\User\updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class UpdateBackendUser extends Migration
{
    public function up()
    {
        Schema::table('backend_users', function ($table) {
            if (!Schema::hasColumn('backend_users', 'phone')) {
                $table->string('phone')->nullable();
            }
            if (!Schema::hasColumn('backend_users', 'address')) {
                $table->string('address')->nullable();
            }
            if (!Schema::hasColumn('backend_users', 'sub_phone')) {
                $table->string('sub_phone')->nullable();
            }
            if (!Schema::hasColumn('backend_users', 'sub_address')) {
                $table->string('sub_address')->nullable();
            }
            if (!Schema::hasColumn('backend_users', 'link_facebook')) {
                $table->string('link_facebook')->nullable();
            }
            if (!Schema::hasColumn('backend_users', 'status')) {
                $table->integer('status')->default(1);
            }
        });
    }


    public function down()
    {
        Schema::table('backend_users', function ($table) {
            $columns = [
                'phone',
                'address',
                'sub_phone',
                'sub_address',
                'link_facebook',
                'status'
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('backend_users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
}
