<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_skills', function (Blueprint $table) {
          $table->unsignedInteger('user_id');
          $table->unsignedInteger('skill_id');

          $table->foreign('user_id')->references('id')->on('users');
          $table->foreign('skill_id')->references('id')->on('skills');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_skills', function (Blueprint $table) {
            $table->dropForeign('users_skills_user_id_foreign');
            $table->dropForeign('users_skills_skill_id_foreign');
        });
        Schema::dropIfExists('users_skills');
    }
}
