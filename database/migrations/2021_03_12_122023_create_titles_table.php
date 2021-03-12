<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('titles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('payer_id');
            $table->foreign('payer_id')->references('id')->on('payers');
            $table->date('due_date');
            $table->double('value')->default(0);
            $table->string('description');
            $table->string('fine_type')->nullable()->comment('[1] => Fixo, [2] => Procentagem');
            $table->double('fine_value')->default(0);
            $table->string('fee_type')->nullable()->comment('[1] => Fixo, [2] => Procentagem');
            $table->double('fee_value')->default(0);
            $table->string('discount_type')->nullable()->comment('[1] => Fixo, [2] => Procentagem');
            $table->double('discount_value')->default(0);
            $table->date('discount_date_limit')->nullable();
            $table->string('reference')->index()->nullable();
            $table->string('instruction_one')->nullable();
            $table->string('instruction_two')->nullable();
            $table->string('instruction_three')->nullable();
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
        Schema::dropIfExists('titles');
    }
}
