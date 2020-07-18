<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('director_id');
            $table->integer('codirector_id');
            $table->integer('status_id'); //TODO verificar valor de status, no es integer es ENUM
            $table->string('title');
            $table->string('general_objetive');
            $table->string('specifics_objetives');
//            $table->string('created_at');
            $table->string('uploaded_at');
            $table->string('report_pdf');
            $table->string('report_uploaded_at');
            $table->string('report_modified_at');
            $table->timestamps();
        });

        Schema::create('project_student', function (Blueprint $table) {
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('restrict');
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('restrict');
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('project_student');
        Schema::dropIfExists('projects');
        Schema::enableForeignKeyConstraints();
    }
}
