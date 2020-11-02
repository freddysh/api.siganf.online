<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dias', function (Blueprint $table) {
            $table->id();
            $table->string('dia');
            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->string('medio_virtual');
            $table->longText('medio_virtual_otros');
            $table->integer('p_16');
            $table->integer('p_17');
            $table->longText('obs_p_17');
            $table->longText('obs_p_18');
            $table->integer('p_19');
            $table->longText('obs_p_19');
            $table->integer('p_20');
            $table->longText('obs_p_20');
            $table->foreignId('asesoria_id')
                ->constrained('asesorias')
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
        Schema::dropIfExists('dias');
    }
}
