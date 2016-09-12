<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('slug');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('accessLevel');
            $table->string('password');
            $table->string('remember_token');
            $table->string('password_token');
            $table->integer('photoId');
            $table->integer('status')->default(1);
            $table->timestamps();
        });

        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'username' => 'Rys',
                'slug' => 'rys',
                'firstname' => 'FURKAN',
                'lastname' => 'KADIOĞLU',
                'email' => 'furkan.kadioglu@gmail.com',
                'accessLevel' => '5',
                'password' => '$2y$10$.JZ.qkWkZHd48M6bhhRbn.1G3XfXwYth7rr32Sts5kaB0ImjLsQFi',
                'remember_token' => 'xcVGNqaSV7NzBpunVv3KA3khm5LxO5Dg6jSEi6LgGwYEwg8fk2ZBV0etxmMf',
                'password_token' => 'FDG1f6kR0LjVloj4jnRhzUyUuT0ib1',
                'photoId' => 1,
                'status' => 1,
                'created_at' => '2016-07-18 21:03:30',
                'updated_at' => '2016-07-18 22:57:43',
            ),
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
