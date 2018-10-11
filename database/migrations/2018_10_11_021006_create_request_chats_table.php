<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_chats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bm_name');
            $table->string('user_name');
            $table->unsignedInteger('bm_id');
            $table->unsignedInteger('compliant_id');
            $table->unsignedInteger('user_id');
            $table->unsignedDecimal('cost');
            $table->string('ref_num', 10);
            $table->boolean('dr_approve'); //0 wateing 1 approve 2 refused
            $table->boolean('pt_closed');
            $table->boolean('closed');
            $table->boolean('cost_pay'); //0 not paid 1 paid

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
        Schema::dropIfExists('request_chats');
    }
}
