<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCartao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cartao', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['C', 'D']);
            $table->enum('status', ['A', 'R', 'B', 'C']);
            $table->string('numero', 16)->unique()->nullable();
            $table->string('senha', 4);
            $table->string('cvv', 3)->nullable();
            $table->date('data_emissao')->nullable();
            $table->date('validade')->nullable();
            $table->enum('categoria', ['N', 'I']);
            $table->bigInteger('bandeira_id', false, true);
            $table->foreign('bandeira_id')->references('id')->on('bandeira');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cartao');
    }
}
