<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_labs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('lab_id');
            $table->unsignedDecimal('value', 7, 2)->default(0);
            $table->string('picture')->nullable();
            $table->date('date_mode');
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('public_users')->onDelete('cascade');
            $table->foreign('lab_id')->references('id')->on('labs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_labs');
    }
}
