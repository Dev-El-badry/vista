<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('job_id');
            $table->text('files')->nullable();
            $table->unsignedInteger('option_id')->nullable)();
            $table->tinyInteger('confirm')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('public_users')->onDelete('cascade');
            $table->foreign('job_id')->references('id')->on('job_titles')->onDelete('cascade');
            $table->foreign('option_id')->references('id')->on('request_options')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_jobs');
    }
}
