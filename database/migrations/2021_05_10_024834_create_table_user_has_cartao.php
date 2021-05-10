<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUserHasCartao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_has_cartao', function (Blueprint $table) {
            $table->bigInteger('user_id', false, true)->index();
            $table->bigInteger('cartao_id', false, true)->index();
            $table->bigInteger('pessoa_id', false, true)->index();
            $table->primary(['user_id', 'cartao_id']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('cartao_id')->references('id')->on('cartao');
            $table->foreign('pessoa_id')->references('id')->on('pessoa');
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
        Schema::dropIfExists('user_has_cartao');
    }
}
