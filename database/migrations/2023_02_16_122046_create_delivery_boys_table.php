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
        Schema::create('delivery_boys', function (Blueprint $table) {
            $table->bigIncrements('id')->from(100001);
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('profile')->nullable();
            $table->string('phone_alternate');
            $table->enum('gender',['Male','Female','Other']);
            $table->string('password')->nullable();
            $table->string('street');
            $table->string('city');
            $table->string('pincode');
            $table->string('state');
            $table->string('country');
            $table->enum('working_status',['Available','On Delivery']);
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('delivery_boys');
    }
};
