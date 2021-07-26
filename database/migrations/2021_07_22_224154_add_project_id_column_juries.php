<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProjectIdColumnJuries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('juries', function(Blueprint $table){
           $table->unsignedBigInteger('project_id');
           $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
        Schema::create('jury_teacher', function (Blueprint $table){
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
            $table->unsignedBigInteger('jury_id');
            $table->foreign('jury_id')->references('id')->on('juries')->onDelete('cascade');
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
        Schema::table('juries', function (Blueprint $table)
        {
            $table->dropColumn('project_id');
        });
        Schema::dropIfExists('jury_teacher');
        Schema::enableForeignKeyConstraints();
    }
}
