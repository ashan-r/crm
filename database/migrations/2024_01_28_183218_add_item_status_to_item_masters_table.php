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
        Schema::table('ac_item_masters', function (Blueprint $table) {
            $table->tinyInteger('item_status')->nullable()->comment('0=old, 1=new, 2=both');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ac_item_masters', function (Blueprint $table) {
            $table->tinyInteger('item_status')->nullable()->comment('0=old, 1=new, 2=both');
        });
    }
};