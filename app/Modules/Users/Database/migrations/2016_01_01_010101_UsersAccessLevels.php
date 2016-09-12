<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersAccessLevels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_accesslevels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('levelName');
            $table->integer('levelPoint');
            $table->string('levelRedirect');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users_accesslevels');
    }
}
