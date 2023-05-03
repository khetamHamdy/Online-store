<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('page_translations')) {
            Schema::create('page_translations', function (Blueprint $table) {
                $table->id();
                $table->integer('page_id');
                $table->string('locale');
                $table->string('title');
                $table->text('description');
                $table->timestamps();
                $table->softDeletes();
            });
            DB::table('page_translations')->insert([
                ['page_id'=>'1','locale'=>'en','title'=>'about us','description'=>'description'],
                ['page_id'=>'1','locale'=>'ar','title'=>'من نحن','description'=>'description'],

                ['page_id'=>'2','locale'=>'en','title'=>'privacy policy','description'=>'description'],
                ['page_id'=>'2','locale'=>'ar','title'=>'سياسة الخصوصية','description'=>'description'],

                ['page_id'=>'3','locale'=>'en','title'=>'terms of use','description'=>'description'],
                ['page_id'=>'3','locale'=>'ar','title'=>'شروط الاستخدام','description'=>'description'],

                ['page_id'=>'4','locale'=>'en','title'=>'return policy page','description'=>'description'],
                ['page_id'=>'4','locale'=>'ar','title'=>'سياسة الارجاع','description'=>'description'],

                ]);
        }
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_translation');
    }
}
