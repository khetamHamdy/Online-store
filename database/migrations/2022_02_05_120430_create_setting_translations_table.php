<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('setting_translations')) {
            Schema::create('setting_translations', function (Blueprint $table) {
                $table->id();
                $table->string('locale')->index();
                $table->integer('setting_id')->unsigned();
//                $table->string('instagram_name');
//                $table->string('address');
//                $table->string('title');
//                $table->string('description');
//                $table->text('key_words');
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
        Schema::dropIfExists('setting_translations');
    }
}
