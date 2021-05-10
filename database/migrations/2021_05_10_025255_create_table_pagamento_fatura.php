<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePagamentoFatura extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamento_fatura', function (Blueprint $table) {
            $table->id();
            $table->dateTime('data');
            $table->decimal('valor', 8, 2, true);
            $table->bigInteger('fatura_id', false, true)->index();
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
        Schema::dropIfExists('pagamento_fatura');
    }
}
