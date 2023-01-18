<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiscountOnInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("invoices", function (Blueprint $table) {
            $table->unsignedBigInteger("voucher_id")->nullable()->after("bill_left");
            $table->decimal("discount_amount", 15, 2)->default(0)->after("bill_left");
            $table->decimal("final_bill", 15, 2)->after("bill_left");
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
            $table->dropColumn("voucher_id");
            $table->dropColumn("discount_amount");
            $table->dropColumn("final_bill");
        });
    }
}
