<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtencionSucursalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atencion_sucursales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_sucursal');
            $table->dateTimeTz('fechaInicio');
            $table->dateTimeTz('fechaFin')->nullable();
            $table->timestamps();
            
            $table->foreign('id_usuario')->references('id')->on('usuarios');
            $table->foreign('id_sucursal')->references('id')->on('sucursales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atencion_sucursales');
    }
}
