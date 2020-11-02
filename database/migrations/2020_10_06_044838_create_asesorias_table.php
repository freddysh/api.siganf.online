<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsesoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asesorias', function (Blueprint $table) {
            $table->id();
            $table->string('anio');
            $table->string('mes');
            $table->string('constancia_nro');
            $table->date('fecha_envio');
            $table->integer('estado');
            $table->integer('hay_visita');
            $table->foreignId('iiee_id');
            $table->foreignId('docente_id');
            $table->foreignId('user_id')
                ->constrained('users')
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
        Schema::dropIfExists('asesorias');
    }
}
