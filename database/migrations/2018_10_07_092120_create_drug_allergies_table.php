<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrugAllergiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drug_allergies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('drug_id');
            
            $table->text('food_allergies');
           
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('public_users')->onDelete('cascade');
            $table->foreign('drug_id')->references('id')->on('drug_allergy_lists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drug_allergies');
    }
}
