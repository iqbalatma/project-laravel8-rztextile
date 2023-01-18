<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDiscountOnPromotionMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("promotion_messages", function (Blueprint $table) {
            $table->decimal("discount")->default(0)->after("customer_segmentation_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("promotion_messages", function (Blueprint $table) {
            $table->dropColumn("discount");
        });
    }
}
