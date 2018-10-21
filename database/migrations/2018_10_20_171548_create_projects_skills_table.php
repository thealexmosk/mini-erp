<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('projects_skills', function (Blueprint $table) {
            $table->unsignedInteger('skill_id');
            $table->unsignedInteger('project_id');

            $table->foreign('skill_id')->references('id')->on('skills');
            $table->foreign('project_id')->references('id')->on('projects');
          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects_skills', function (Blueprint $table) {
            $table->dropForeign('projects_skills_project_id_foreign');
            $table->dropForeign('projects_skills_skill_id_foreign');
        });
        Schema::dropIfExists('projects_skills');
    }
}
