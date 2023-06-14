<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->string('transaction_code')->primary();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('coupon_id')->nullable()->unsigned();
            $table->integer('discount')->nullable();
            $table->integer('discount_price')->nullable();
            $table->integer('sub_total')->nullable();
            $table->integer('grand_total')->nullable();
            $table->integer('paid')->nullable();
            $table->integer('change')->nullable();
            $table->string('foto')->nullable();
            $table->integer('status')->default('0');
            $table->boolean('valid');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('coupon_id')->references('id')->on('coupons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};