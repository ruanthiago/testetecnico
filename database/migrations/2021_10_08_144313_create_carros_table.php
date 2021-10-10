<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->nullable()->index();
            $table->string('nome_veiculo')->nullable();
            $table->string('link')->nullable();
            $table->string('ano')->nullable();
            $table->string('combustivel')->nullable();
            $table->string('portas')->nullable();
            $table->string('quilometragem')->nullable();
            $table->string('cambio')->nullable();
            $table->string('cor')->nullable();
            $table->string('preco')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carros');
    }
}
