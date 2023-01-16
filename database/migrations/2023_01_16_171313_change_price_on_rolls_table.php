<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePriceOnRollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("rolls", function (Blueprint $table) {
            $table->decimal("basic_price", 15, 2)->change();
            $table->decimal("selling_price", 15, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("rolls", function (Blueprint $table) {
            $table->float("basic_price")->change();
            $table->float("selling_price")->change();
        });
    }
}
