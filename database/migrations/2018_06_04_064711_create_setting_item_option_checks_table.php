<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingItemOptionChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_item_option_checks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedinteger('setting_item_id');
            $table->string('name');
            $table->boolean('status')->default(0);
            $table->timestamps();

            $table->foreign('setting_item_id')->references('id')->on('setting_items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::enableForeignKeyConstraints();
        Schema::table('setting_item_option_checks', function(Blueprint $table) {
            $table->dropForeign(['setting_item_id']);
        });
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('setting_item_option_checks');
    }
}
