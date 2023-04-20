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
        Schema::create('shipment_routes', function (Blueprint $table) {
            $table->bigIncrements('id')->from(100001);

            $table->foreignId('shipment_id')->references('id')->on('shipments')->nullable();
            $table->foreignId('branch_id')->references('id')->on('branches')->nullable();

            $table->foreignId('pickup_branch_id')->nullable();
            $table->foreignId('pickup_boy_id')->nullable();
            $table->foreignId('pickup_otp')->nullable();

            $table->foreignId('delivery_branch_id')->nullable();
            $table->foreignId('delivery_boy_id')->nullable();
            $table->foreignId('delivery_otp')->nullable();

            $table->boolean('recieved_by_branch')->default(false);
            $table->timestamp('recivied_at')->nullable();
            
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
        Schema::dropIfExists('shipment_routes');
    }
};
