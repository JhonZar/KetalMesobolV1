<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_categoria');
            $table->unsignedBigInteger('idMaterial');
            $table->unsignedBigInteger('idColor');
            $table->string('nombre',25);
            $table->decimal('precio',25);
            $table->integer('cantidad');
            $table->string('descripcion');
            $table->string('imagen',50);
            $table->enum('tafilete', ['CUERO', 'ESPONJA', 'ESPONJA CON SELLO', 'ESPONJA DELGADO', 'CUERINA NEGRO', 'PLASTICO', 'CARTON'])->nullable();
            $table->enum('talla', ['2 1/2', '3', '3 1/2', '4', '4 1/2', '5', '5 1/2', '6', '6 1/2', '7'])->nullable();
            $table->enum('publico', ['si', 'no', 'pedido']);
            $table->timestamps();

            $table->foreign('idMaterial')->references('id')->on('materiales');
            $table->foreign('id_categoria')->references('id')->on('categorias');
            $table->foreign('idColor')->references('id')->on('colores');
        

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
