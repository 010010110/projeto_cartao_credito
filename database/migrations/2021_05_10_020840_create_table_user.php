<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['A', 'F', 'C']);
            $table->enum('status', ['A', 'R', 'I']);
            $table->string('email', 50)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->decimal('renda_mensal', 8, 2, true);
            $table->decimal('limite', 6, 2, true);
            $table->bigInteger('pessoa_id', false, true);
            $table->foreign('pessoa_id')->references('id')->on('pessoa');
            $table->rememberToken();
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
        Schema::dropIfExists('user');
    }
}
