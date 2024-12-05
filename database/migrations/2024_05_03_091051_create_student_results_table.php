<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_results', function (Blueprint $table) {
            $table->id();

            $table->foreignId('Students_id')->references('id')->on('students');
            // $table->foreignId('ClassName')->references('class')->on('students');

            // $table->foreignId('Subject_id')->references('id')->on('subjects');
            $table->string('className');



            $table->string('name');
            $table->integer('AmaliSolatMarks');
            $table->integer('PenghayatanMarks');
            $table->integer('TilawahMarks');
            $table->integer('PelajaranJawiMarks');
            $table->integer('SirahMarks');
            $table->integer('UlumMarks');
            $table->integer('AdabMarks');
            $table->integer('LughahMarks');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_results');
    }
};
