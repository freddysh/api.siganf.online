<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCriteriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criterios', function (Blueprint $table) {
            $table->id();
            $table->string('aspecto');
            $table->string('criterio');
            $table->string('opcion');
            $table->string('opcion_1');
            $table->string('opcion_2');
            $table->string('opcion_3');
            $table->string('opcion_4');
            $table->string('observacion');
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
        Schema::dropIfExists('criterios');
    }
}
