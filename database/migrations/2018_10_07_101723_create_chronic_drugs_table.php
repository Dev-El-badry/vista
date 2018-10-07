<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChronicDrugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chronic_drugs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('drug_id');
            $table->string('dose');
            $table->boolean('till_now');
            $table->integer('will_stop')->default(0);
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('public_users')->onDelete('cascade');
            $table->foreign('drug_id')->references('id')->on('chronic_drug_lists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chronic_drugs');
    }
}
