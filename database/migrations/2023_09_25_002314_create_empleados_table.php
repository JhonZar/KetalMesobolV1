<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_rol');
            $table->string('ci',10)->unique();
            $table->string('nombre',100);
            $table->date('fecha_nac')->nullable();
            $table->string('telefono',8);
            $table->string('email')->nullable();
            $table->timestamps();

            $table->foreign('id_rol')->references('id')->on('roles')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
