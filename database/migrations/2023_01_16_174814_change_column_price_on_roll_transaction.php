<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnPriceOnRollTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("roll_transactions", function (Blueprint $table) {
            $table->decimal("capital", 15, 2)->change();
            $table->decimal("profit", 15, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("roll_transactions", function (Blueprint $table) {
            $table->float("capital")->change();
            $table->float("profit")->change();
        });
    }
}
