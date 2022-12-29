<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_data', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user')->unsigned();
            $table->text('address');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->integer('id_agama')->unsigned();
            $table->string('foto_ktp');
            $table->integer('age');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_agama')->references('id')->on('agamas');
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
        Schema::dropIfExists('detail_data');
    }
};
