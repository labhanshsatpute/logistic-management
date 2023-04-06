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
        Schema::create('shippment_payment_transactions', function (Blueprint $table) {
            $table->bigIncrements('id')->from(100001);
            $table->foreignId('user_id')->references('id')->on('users')->nullable();
            $table->foreignId('shippment_id')->references('id')->on('shippments')->nullable();
            $table->string('token');
            $table->string('gateway');
            $table->string('method');
            $table->enum('status',['Pending','Failed','Completed'])->default('Pending');
            $table->string('transaction_id')->nullable();
            $table->double('amount',16,2);
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
        Schema::dropIfExists('shippment_payment_transactions');
    }
};
