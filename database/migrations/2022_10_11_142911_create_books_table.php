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
            $table->bigInteger('id_room');
            $table->bigInteger('id_user');
            $table->string('name');
            $table->string('nik');
            $table->string('nota');
            $table->date('book_date');
            $table->date('checkin')->nullable();
            $table->date('checkout')->nullable();
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
