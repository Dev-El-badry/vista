<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('login_social');
            $table->enum('sex', ['male', 'female']);
            $table->unsignedInteger('age')->nullable();
            $table->string('country', 80)->nullable();
            $table->string('state', 80)->nullable();
            $table->string('address1', 120)->nullable();
            $table->string('address2', 120)->nullable();
            $table->string('telnum')->nullable();
            $table->string('picture')->nullable();
            $table->boolean('group_id')->default(0);
            $table->string('social_account_title', 60)->nullable();
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
        Schema::dropIfExists('public_users');
    }
}
