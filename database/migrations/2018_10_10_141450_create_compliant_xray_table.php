<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompliantXrayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compliant_xray', function (Blueprint $table) {
            $table->increments('id');
            $table->text('report');
            $table->string('picture')->nullable();
            $table->date('date_mode');
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
        Schema::dropIfExists('compliant_xray');
    }
}
