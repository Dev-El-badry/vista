<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotifyAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notify_admin', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('count_files');
            $table->unsignedInteger('job_id');
            $table->unsignedInteger('user_id');
            $table->boolean('opened')->default(0);
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
        Schema::dropIfExists('notify_admin');
    }
}
