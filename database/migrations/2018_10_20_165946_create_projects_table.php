<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
             $table->string('title');
             $table->string('description', 2000);
             $table->string('organization')->nullable();
             $table->date('start')->nullable();
             $table->date('end')->default(date("Y-m-d H:i:s"));
             $table->string('role');
             $table->string('link')->nullable();
             // $table->string('skills_list')->nullable();
             $table->enum('type', ['work', 'book', 'course', 'blog', 'other']);
             $table->unsignedInteger('user_id');
             $table->timestamps();

             $table->foreign('user_id')->references('id')->on('users');
         });
     }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign('projects_user_id_foreign');
        });

        Schema::dropIfExists('projects');
    }
}
