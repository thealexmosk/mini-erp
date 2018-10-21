<?php

use Illuminate\Database\Seeder;

class UsersSkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_id = \App\User::where('name', 'admin')->value('id');
        $php_skill_id = \App\Skill::where('name', 'PHP')->value('id');
        $laravel_skill_id = \App\Skill::where('name', 'Laravel')->value('id');

        DB::table('users_skills')->insert([
            'user_id' => $admin_id,
            'skill_id' => $php_skill_id
        ]);

        DB::table('users_skills')->insert([
            'user_id' => $admin_id,
            'skill_id' => $laravel_skill_id
        ]);
    }
}
