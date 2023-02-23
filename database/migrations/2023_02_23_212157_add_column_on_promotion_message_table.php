<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnOnPromotionMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("promotion_messages", function (Blueprint $table) {
            $table->string("message_prize")->after("message")->nullable();
            $table->string("prize")->after("message_prize")->nullable();
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
            $table->dropColumn("message_prize");
            $table->dropColumn("prize");
        });
    }
}
