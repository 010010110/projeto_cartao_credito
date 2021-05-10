<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUserHasFatura extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_has_fatura', function (Blueprint $table) {
            $table->bigInteger('user_id', false, true)->index();
            $table->bigInteger('fatura_id', false, true)->index();
            $table->primary(['user_id', 'fatura_id']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('fatura_id')->references('id')->on('fatura');
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
        Schema::dropIfExists('user_has_fatura');
    }
}
