<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParametrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parametros', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('cabeca');
            $table->integer('olho');
            $table->integer('boca');
            $table->integer('braco');
            $table->integer('perna');
            $table->integer('orelha');
            $table->integer('nariz');
            $table->integer('queixo');
            $table->integer('tronco');
            $table->integer('pe');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parametros');
    }
}
