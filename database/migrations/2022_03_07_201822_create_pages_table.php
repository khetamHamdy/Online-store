<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('pages')) {
            Schema::create('pages', function (Blueprint $table) {
                $table->id();
                $table->string('image')->nullable();
                $table->integer('views');
                $table->string('slug');
                $table->enum('status',['active','not_active']);
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
                $table->softDeletes();
            });
            DB::table('pages')->insert([
                ['image'=>'image.png','views'=>'1','slug'=>'about-us','status'=>'active',],
                ['image'=>'image.png','views'=>'1','slug'=>'privacy-policy','status'=>'active',],
                ['image'=>'image.png','views'=>'1','slug'=>'terms-of-use','status'=>'active',],
                ['image'=>'image.png','views'=>'1','slug'=>'return_policy_page','status'=>'active',],
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
        Schema::dropIfExists('pages');
    }
}
