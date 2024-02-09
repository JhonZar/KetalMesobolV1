<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinatariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destinatarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pedido');
            $table->unsignedBigInteger('id_cliente');
            $table->unsignedBigInteger('id_producto');
            $table->integer('cantidad');
            $table->date('fecha_Entrega');
            $table->enum('talla', ['2 1/2', '3', '3 1/2', '4', '4 1/2', '5', '5 1/2', '6', '6 1/2', '7'])->nullable();
            $table->string('obs')->nullable();
            $table->timestamps();

            $table->foreign('id_pedido')->references('id')->on('pedidos');
            $table->foreign('id_cliente')->references('id')->on('clientes');
            $table->foreign('id_producto')->references('id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('destinatarios');
    }
}
