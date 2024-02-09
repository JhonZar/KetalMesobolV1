<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_estados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_estado');
            $table->unsignedBigInteger('id_pedido');
            $table->unsignedBigInteger('id_usuarios')->nullable();
            $table->date('fecha');
            $table->timestamps();

            $table->foreign('id_estado')->references('id')->on('estados');
            $table->foreign('id_pedido')->references('id')->on('pedidos');
            $table->foreign('id_usuarios')->references('id')->on('usuarios');
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historial_estados');
    }
}
