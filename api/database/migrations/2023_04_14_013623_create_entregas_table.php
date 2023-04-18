<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntregasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entregas', function (Blueprint $table) {
            $table->id();
            $table->integer('codigo');
            $table->dateTime('data_emissao');   
            $table->text('observacao')->nullable();
            $table->unsignedBigInteger('entregador_id');
            $table->foreign('entregador_id')->references('id')->on('entregadores');            
            $table->enum('status',['pendente','saiu para entrega', 'cancelado', 'concluida']);
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
        Schema::dropIfExists('entregas');
    }
}
