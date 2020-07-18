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
            $table->integer('status_id');
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
