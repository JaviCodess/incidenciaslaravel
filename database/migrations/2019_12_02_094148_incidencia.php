<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Incidencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('incidencia', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fecha');
            $table->string('aula');
            $table->unsignedBigInteger('profesorId');
            $table->foreign('profesorId')->references('id')->on('usuario');
            $table->string('hora')->nullable();
            $table->string('codigo_equipo');
            $table->string('codigo_incidencia');
            $table->string('informacion')->nullable();
            $table->string('estado')->default('En proceso');
            $table->string('archivo')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('incidencia');
    }
}
