<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersInformationsDatas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_informations_datas', function (Blueprint $table) {
            $table->integer('templateId');
            $table->integer('userId')->unsigned();
            $table->string('data');
            $table->timestamps();

            $table->foreign('userId')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['userId']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users_informations_datas');
    }
}
