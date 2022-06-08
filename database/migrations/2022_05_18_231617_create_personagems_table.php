<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonagemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personagems', function (Blueprint $table) {
            $table->id();
            $table->biginteger('cor_id')->unsigned();
            $table->biginteger('parametro_id')->unsigned();
            $table->foreign('cor_id')->references('id')->on('cores');
            $table->foreign('parametro_id')->references('id')->on('parametros');
            $table->timestamps();
            $table->string('nick', 255);
            $table->enum('classe',['Mago','Guerreiro','Lutador','Curandeiro','Necromante','Arqueiro']);
            $table->enum('Sexo',['Feminino','Masculino']);
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personagems');
    }
}
