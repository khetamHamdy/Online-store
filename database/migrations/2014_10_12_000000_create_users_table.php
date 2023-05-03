<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('user_name')->nullable();
                $table->string('email')->nullable();
                $table->string('mobile')->nullable();
                $table->enum('notifications',['1','0'])->default('1')->comment('1->yes , 0->no');
                $table->enum('status',['active','not_active']);
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->enum('type',['1','2','3'])->comment('1->user , 2->restaurant , 3->truck');
                $table->rememberToken();
                $table->string('image')->nullable();
                $table->string('latitude')->nullable();
                $table->string('longitude')->nullable();
                $table->enum('opening_status',['1','2','3'])->default('1')->comment('1->open , 2->crowded , 3->closed');
                $table->string('branch_name')->nullable();
                $table->string('supplier_code')->nullable();
                $table->enum('accept_pick_up',['1','0'])->default('1')->comment('1->yes ,0->no');
                $table->enum('is_deleted ',['1','0'])->default('1')->comment('1->yes , 0->no');
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
                $table->softDeletes();
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
