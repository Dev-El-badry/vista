<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompliantMedicalReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compliant_medical_report', function (Blueprint $table) {
            $table->increments('id');
            $table->string('picture');
            $table->unsignedInteger('compliant_id');
            $table->timestamps();

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
        Schema::dropIfExists('compliant_medical_report');
    }
}
