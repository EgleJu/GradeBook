<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('lecture_id')->default(1)->unsigned();
            $table->bigInteger('student_id')->default(1)->unsigned();
            $table->bigInteger('grade');
            $table->timestamps();

            $table->index('grade');
            $table->index('lecture_id');
            $table->index('student_id');

            $table->foreign('lecture_id')
                ->references('id')
                ->on('lectures')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_lithuanian_ci';
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grades');
    }
}
