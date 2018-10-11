<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompliantRecentDrugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compliant_recent_drugs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('drug_id');
            $table->string('dose');
            $table->unsignedInteger('compliant_id');
            $table->timestamps();

            $table->foreign('drug_id')->references('id')->on('chronic_drug_lists')->onDelete('cascade');
            $table->foreign('compliant_id')->references('id')->on('compliant_forms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compliant_recent_drugs');
    }
}
