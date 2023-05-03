<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                $table->integer('user_id')->default(0);
                $table->integer('provider_id')->default(0);
                $table->string('fcm_token')->nullable();
                $table->double('total');
                $table->double('sub_total');
                $table->double('discount')->default(0);
                $table->integer('promo_code_id')->nullable();
                $table->string('promo_code_name')->nullable();
                $table->double('promo_code_amount')->nullable();
                $table->double('promo_code_type')->nullable()->comment('0->percentage , 1->amount');
                $table->string('customer_name');
                $table->string('customer_email');
                $table->string('customer_mobile');
                $table->integer('payment_method')->comment('1-> online , 2-> cache_on_pickup');
                $table->integer('payment_status')->comment('1 ->yes , 0->no')->default(0);
                $table->string('payment_ref')->nullable();
                $table->date('order_date');
                $table->enum('status', ['1','2','3','4','5'])->comment('1->confirmed, 2-> under_preparing , 3->ready_for_pickup , 4->completed , 5->canceled');
                $table->string('refuse_comment')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
