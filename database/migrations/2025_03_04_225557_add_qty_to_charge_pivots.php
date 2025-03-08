<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('charge_pivots', function (Blueprint $table) {
            $table->integer('qty')->default(1);
        });
    }

    public function down()
    {
        Schema::table('charge_pivots', function (Blueprint $table) {
            $table->dropColumn(['qty']);
        });
    }
};

