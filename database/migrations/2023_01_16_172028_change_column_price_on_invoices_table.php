<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnPriceOnInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("invoices", function (Blueprint $table) {
            $table->decimal("total_capital", 15, 2)->change();
            $table->decimal("total_bill", 15, 2)->change();
            $table->decimal("total_profit", 15, 2)->change();
            $table->decimal("total_paid_amount", 15, 2)->change();
            $table->decimal("bill_left", 15, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("invoices", function (Blueprint $table) {
            $table->float("total_capital")->change();
            $table->float("total_bill")->change();
            $table->float("total_profit")->change();
            $table->float("total_paid_amount")->change();
            $table->float("bill_left")->change();
        });
    }
}
