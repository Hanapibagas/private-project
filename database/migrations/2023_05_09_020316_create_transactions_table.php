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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('coupon_id')->constrained('coupons')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('discount')->nullable();
            $table->integer('discount_price')->nullable();
            $table->integer('sub_total')->nullable();
            $table->integer('grand_total')->nullable();
            $table->integer('paid')->nullable();
            $table->integer('change')->nullable();
            $table->boolean('valid');
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
