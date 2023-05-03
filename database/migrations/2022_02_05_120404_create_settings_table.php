<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('settings')) {
            Schema::create('settings', function (Blueprint $table) {
                $table->id();
                $table->integer('paginateTotal');
                $table->string('login_image');
                $table->string('app_logo');
                $table->string('info_email');
                $table->string('mobile');
                $table->string('facebook');
                $table->string('twitter');
                $table->string('instagram');
//                $table->string('latitude');
//                $table->string('longitude');
                $table->enum('is_maintenance_mode',[0,1])->comment('0->off 1->on');
                $table->enum('is_allow_register',[0,1])->comment('0->off 1->on');
                $table->enum('is_allow_login',[0,1])->comment('0->off 1->on');
                $table->enum('is_allow_buy',[0,1])->comment('0->off 1->on');
                $table->timestamps();
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
        Schema::dropIfExists('settings');
    }
}
