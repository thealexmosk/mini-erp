<?php

use Illuminate\Database\Seeder;

class SkillsSeeder extends Seeder
{

    private $init_skills = [
      'php', 'laravel', 'symfony', 'ux/ui', 'javascript',
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      foreach ($this->init_skills as $skill) {
        DB::table('skills')->insert([
            'name' => $skill
        ]);
      }
    }
}
