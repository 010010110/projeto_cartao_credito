<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableFaturaHasItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fatura_has_item', function (Blueprint $table) {
            $table->bigInteger('fatura_id', false, true)->index();
            $table->bigInteger('item_id', false, true)->index();
            $table->integer('parcela', false, true);
            $table->primary(['fatura_id', 'item_id']);
            $table->foreign('fatura_id')->references('id')->on('fatura');
            $table->foreign('item_id')->references('id')->on('item');
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
        Schema::dropIfExists('fatura_has_item');
    }
}
