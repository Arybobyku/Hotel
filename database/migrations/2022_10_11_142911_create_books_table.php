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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_hotel');
            $table->bigInteger('id_room')->default('0');
            $table->string('room');
            $table->bigInteger('id_user');
            $table->bigInteger('id_platform');
            $table->string('guestname');
            $table->string('nik');
            $table->string('nota');
            $table->string('booking_type');
            $table->string('payment_type');
            $table->bigInteger('price');
            // $table->bigInteger('price_app');
            $table->date('book_date');
            $table->date('book_date_end');
            $table->integer('days');
            $table->date('checkin')->nullable();
            $table->date('checkout')->nullable();
            $table->bigInteger('platform_fee2')->default('0');
            $table->bigInteger('assured_stay')->default('0');
            $table->bigInteger('tipforstaf')->default('0');
            $table->bigInteger('upgrade_room')->default('0');
            $table->bigInteger('travel_protection')->default('0');
            $table->bigInteger('member_redclub')->default('0');
            $table->bigInteger('breakfast')->default('0');
            $table->bigInteger('early_checkin')->default('0');
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
        Schema::dropIfExists('checkin');
    }
};
