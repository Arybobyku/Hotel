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
        Schema::table('charge_types', function (Blueprint $table) {
             $table->softDeletes(); // Add the deleted_at column
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('charge_types', function (Blueprint $table) {
            //
             $table->dropSoftDeletes(); // Remove the deleted_at column

        });
    }
};
