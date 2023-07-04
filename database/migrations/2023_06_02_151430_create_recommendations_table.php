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
        Schema::create('recommendations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('major_id');
            $table->unsignedBigInteger('university_id');
            $table->string('decision');

            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('major_id')->references('id')->on('majors');
            $table->foreign('university_id')->references('id')->on('universities');

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
        Schema::dropIfExists('recommendations');
    }
};
