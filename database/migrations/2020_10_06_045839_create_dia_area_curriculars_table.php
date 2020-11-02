<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiaAreaCurricularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dia_area_curriculars', function (Blueprint $table) {
            $table->id();
            $table->string('nivel');
            $table->string('nombre');
            $table->string('detalle')->nullable();
            $table->integer('estado');
            $table->foreignId('dia_id')
                ->constrained('dias')
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
        Schema::dropIfExists('dia_area_curriculars');
    }
}
