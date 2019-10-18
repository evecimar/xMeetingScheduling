<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Agendamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->text('descricao');
            $table->unsignedInteger('sala_id')->nullable();
            $table->string('solicitante_email');
            $table->dateTime('inicio');
            $table->dateTime('fim');
            $table->unsignedInteger('status_id')->default(1);
            $table->timestamps();

            $table->foreign('sala_id')->references('id')->on('salas')->onDelete("restrict"); 
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete("restrict"); 
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agendamentos');
    }
}
