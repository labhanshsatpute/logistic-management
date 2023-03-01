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
        Schema::create('packages', function (Blueprint $table) {
            $table->bigIncrements('id')->from(100001);

            $table->string('sender_name');
            $table->string('sender_email');
            $table->string('sender_phone_primary');
            $table->string('sender_phone_alternate')->nullable();

            $table->string('sender_address_home')->nullable();
            $table->string('sender_address_street');
            $table->string('sender_address_city');
            $table->string('sender_address_pincode');
            $table->string('sender_address_state');
            $table->string('sender_address_country');

            $table->string('reciever_name');
            $table->string('reciever_email');
            $table->string('reciever_phone_primary');
            $table->string('reciever_phone_alternate')->nullable();

            $table->string('reciever_address_home')->nullable();
            $table->string('reciever_address_street');
            $table->string('reciever_address_city');
            $table->string('reciever_address_pincode');
            $table->string('reciever_address_state');
            $table->string('reciever_address_country');

            $table->string('package_name');
            $table->text('package_summary')->nullable();
            $table->longText('package_description')->nullable();
            $table->enum('package_type',['Grocery','Food & Vegetable','Electronics','Home Appliances','Furniture','Handle With Care','Vaccine','Medicine','Liquor','Other']);
            $table->enum('package_payment',['Prepaid','COD']);
            $table->double('package_payment_amount',16,2)->nullable();

            $table->double('package_length',16,2);
            $table->double('package_width',16,2);
            $table->double('package_height',16,2);
            $table->double('package_weight',16,2);

            $table->date('pickup_date');
            $table->enum('pickup_slot',['Morning','Afternoon','Evening']);
            $table->enum('pickup_status',['Pending','Picked'])->nullable();

            $table->date('delivery_date')->nullable();            
            $table->enum('delivery_slot',['Morning','Afternoon','Evening'])->nullable();
            $table->enum('delivery_status',['Pending','Picked'])->nullable();

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
        Schema::dropIfExists('packages');
    }
};
