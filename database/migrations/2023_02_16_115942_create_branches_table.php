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
        Schema::create('branches', function (Blueprint $table) {
            $table->bigIncrements('id')->from(100001);
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('password')->nullable();
            $table->string('street');
            $table->string('city');
            $table->string('pincode');
            $table->string('state');
            $table->string('country');
            $table->enum('type',['Regional Warehouse','City Office','Head Office'])->nullable();
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
        Schema::dropIfExists('branches');
    }
};
