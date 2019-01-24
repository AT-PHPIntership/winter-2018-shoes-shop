<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('code_id')->nullable();
            $table->foreign('code_id')->references('id')->on('codes');
            $table->date('delivered_at')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('shipping_address')->nullable();
            $table->string('phone_number')->length(10)->nullable();
            $table->decimal('total_amount');
            $table->tinyInteger('status')->length(1)->default(0);
            $table->timestamps();
        });
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
