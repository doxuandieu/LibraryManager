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
        Schema::create('dissertations', function (Blueprint $table) {
            $table->id();
            $table->string('year', 20);
            $table->string('semester', 20);
            $table->string('student_id', 8);
            $table->string('class_id', 8);
            $table->string('student_name', 50);
            $table->string('gender', 8);
            $table->integer('yearOfBirth');
            $table->string('major', 50);
            $table->string('titleInVietnamese', 100);
            $table->string('titleInEnglish', 100);
            $table->string('lecturer_name', 50);
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('dissertations');
    }
};
