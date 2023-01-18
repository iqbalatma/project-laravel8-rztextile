<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomerSegmentationIdColumnToPromotionMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('promotion_messages', function (Blueprint $table) {
            $table->unsignedBigInteger("customer_segmentation_id")->after("message");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('promotion_messages', function (Blueprint $table) {
            $table->dropColumn("customer_segmentation_id");
        });
    }
}
