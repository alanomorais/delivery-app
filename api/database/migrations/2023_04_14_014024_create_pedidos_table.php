<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->integer('pedido');
            $table->dateTime('data_pedido');
            $table->dateTime('data_saida')->nullable();
            $table->dateTime('data_entrega')->nullable();
            $table->text('observacao')->nullable();
            $table->double('valor',4,2)->nullable();
            $table->foreignId('cliente_id')->constrained();
            $table->unsignedBigInteger('entregador_id')->nullable();
            $table->foreign('entregador_id')->references('id')->on('entregadores');
            $table->foreignId('entrega_id')->nullable()->constrained()->nullable();
            $table->enum('status',['pendente','saiu para entrega', 'cancelado', 'entregue']);
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
        Schema::dropIfExists('pedidos');
    }
}
