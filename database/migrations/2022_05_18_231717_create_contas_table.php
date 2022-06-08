<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contas', function (Blueprint $table) {
            $table->id();
            $table->biginteger('personagems_id')->unsigned();
            $table->biginteger('endereco_id')->unsigned();
            $table->foreign('personagems_id')->references('id')->on('personagems');
            $table->foreign('endereco_id')->references('id')->on('enderecos');
            $table->timestamps();            
            $table->string('nome', 255);
            $table->string('senha');
            $table->string('email');
            $table->date('nascimento');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contas');
    }
}
