<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChronicDiseaseCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chronic_disease_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cd_title');
            $table->integer('parent_id');
            $table->boolean('status')->default(0);
            $table->integer('priority')->default(0);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chronic_disease_categories');
    }
}
