<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIieesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iiees', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_modular')->unique();
            $table->string('nombre');
            $table->string('nivel');
            $table->string('centro_poblado');
            $table->string('local');
            $table->longText('direccion');
            $table->string('departamento');
            $table->string('provincia');
            $table->string('distrito');
            $table->foreignId('ugel_id')
                ->constrained('ugels')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('iiees');
    }
}
