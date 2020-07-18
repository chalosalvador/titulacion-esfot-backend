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
            $table->increments('id');
            $table->integer('director_id');
            $table->integer('codirector_id');
            $table->integer('status_id');
            $table->string('title', 45);
            $table->string('general_objective', 45);
            $table->string('specifics_objectives', 45);
            $table->timestamps();
            $table->string('uploaded_at', 45);
            $table->string('report_pdf', 45);
            $table->string('report_uploaded_at', 45 );
            $table->string('report_modified_at', 45 );
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