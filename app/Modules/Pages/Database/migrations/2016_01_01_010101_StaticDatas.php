<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StaticDatas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages_static_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('type');
            $table->text('content');
        });

        \DB::table('pages_static_datas')->insert(array (
            0 => 
            array (
                'id' => 8,
                'slug' => 'anabaslik',
                'type' => 'Contents',
                'content' => 'Modvele Hoşgeldiniz!',
            ),
            1 => 
            array (
                'id' => 9,
                'slug' => 'anaicerik',
                'type' => 'Contents',
                'content' => 'Bu otomatik olarak oluşturulmuş bir içeriktir.',
            ),
            2 => 
            array (
                'id' => 14,
                'slug' => 'homepage',
                'type' => 'Homepage',
            'content' => '@extends(\'masters.main\') 

            @section(\'content\')
            <div class="jumbotron">
            <h1>[-anabaslik-]</h1>
            <p>[-anaicerik-]</p>
            @if(!Auth::user()) 
            <p>
            <a class="btn btn-lg btn-primary" href="{{ url(\'/Users/login\') }}" role="button">Giriş Yap »</a>
            </p>
            @endif
            </div>
            @endsection',
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
        Schema::drop('pages_static_datas');
    }
}
