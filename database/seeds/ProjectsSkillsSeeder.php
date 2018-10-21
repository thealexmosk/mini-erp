<?php

use Illuminate\Database\Seeder;

class ProjectsSkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $test1_project_id = \App\Project::where('title', 'Test 1')->value('id');
        $test2_project_id = \App\Project::where('title', 'Test 2')->value('id');
        $php_skill_id = \App\Skill::where('name', 'PHP')->value('id');
        $laravel_skill_id = \App\Skill::where('name', 'Laravel')->value('id');

        DB::table('projects_skills')->insert([
            'project_id' => $test1_project_id,
            'skill_id' => $php_skill_id
        ]);

        DB::table('projects_skills')->insert([
            'project_id' => $test2_project_id,
            'skill_id' => $laravel_skill_id
        ]);
    }
}
