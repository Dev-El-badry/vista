<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_summaries', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('chronic_diseases_approve')->default(0);
            $table->boolean('xray_approve')->default(0);
            $table->boolean('lab_invent_approve')->default(0);
            $table->boolean('allergies_approve')->default(0);
            $table->boolean('chronic_drugs_approve')->default(0);
            $table->boolean('recent_drugs_approve')->default(0);
            $table->boolean('old_reports_approve')->default(0);
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('public_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_summaries');
    }
}
