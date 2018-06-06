<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsOptionChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_option_checks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedinteger('item_id');
            $table->unsignedinteger('setting_item_option_check_id');
            $table->boolean('status')->default(0);
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('setting_item_option_check_id')->references('id')->on('setting_item_option_checks');
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
        Schema::table('items_option_checks', function(Blueprint $table) {
            $table->dropForeign([
                'item_id',
                'setting_item_option_check_id'
            ]);
        });
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('items_option_checks');
    }
}
