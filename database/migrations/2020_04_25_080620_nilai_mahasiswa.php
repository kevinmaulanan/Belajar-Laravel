<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NilaiMahasiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('nilai');
            $table->unsignedBigInteger('id_matkul');
            $table->unsignedBigInteger('id_student');
            $table->foreign('id_matkul')->references('id')->on('matkuls')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_student')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade;');
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
        //
    }
}
