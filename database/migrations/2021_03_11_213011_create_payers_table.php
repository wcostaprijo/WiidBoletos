<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name'); // Nome
            $table->string('document'); // Documento
            $table->string('phone'); // Telefone
            $table->string('email'); // E-mail
            $table->date('birth'); // Data de nascimento
            $table->string('address_cep');  // CEP
            $table->string('address_street'); // Rua
            $table->string('address_district'); // Bairro
            $table->string('address_number'); // Número da casa
            $table->string('address_complement'); // Complemento
            $table->string('address_city'); // Cidade
            $table->string('address_state'); // Estado
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
        Schema::dropIfExists('payers');
    }
}
