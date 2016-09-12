<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->text('content');

            $table->integer('userId')->unsigned();
            $table->integer('masterPageId')->unsigned();

            $table->integer('showMenu')->default(0);
            $table->integer('photoId')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();

            $table->foreign('userId')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

        });

         \DB::table('pages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Modvel Configrations',
                'slug' => 'modvel-configrations',
                'description' => 'Modvel Configrations',
                'content' => '<p>Modvel Configrations</p>
',
                'userId' => 1,
                'masterPageId' => 0,
                'showMenu' => 1,
                'photoId' => NULL,
                'status' => 1,
                'created_at' => '2016-07-18 23:08:06',
                'updated_at' => '2016-07-18 23:29:16',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Installation',
                'slug' => 'installation',
                'description' => '',
                'content' => '<p>Installation Steps</p>
',
                'userId' => 1,
                'masterPageId' => 1,
                'showMenu' => 1,
                'photoId' => NULL,
                'status' => 1,
                'created_at' => '2016-07-18 23:34:10',
                'updated_at' => '2016-07-18 23:34:10',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'Technologies',
                'slug' => 'technologies',
                'description' => '',
                'content' => '<p>Hello World.</p>
',
                'userId' => 1,
                'masterPageId' => 0,
                'showMenu' => 1,
                'photoId' => NULL,
                'status' => 1,
                'created_at' => '2016-07-19 06:25:02',
                'updated_at' => '2016-07-19 06:25:02',
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'Backend Technologies',
                'slug' => 'backend-technologies',
                'description' => '',
                'content' => '<p>For example laravel.</p>
',
                'userId' => 1,
                'masterPageId' => 3,
                'showMenu' => 1,
                'photoId' => NULL,
                'status' => 1,
                'created_at' => '2016-07-19 06:30:48',
                'updated_at' => '2016-07-19 06:30:48',
            ),
            4 => 
            array (
                'id' => 5,
                'title' => 'Contributers',
                'slug' => 'contributers',
                'description' => '',
                'content' => '<p>FK</p>
',
                'userId' => 1,
                'masterPageId' => 0,
                'showMenu' => 1,
                'photoId' => NULL,
                'status' => 1,
                'created_at' => '2016-07-19 20:29:52',
                'updated_at' => '2016-07-19 20:29:52',
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
        Schema::drop('pages');
    }
}
