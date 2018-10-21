<?php

use Illuminate\Database\Seeder;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $admin_id = \App\User::where('name', 'admin')->value('id');

      DB::table('projects')->insert([
          'title' => 'Test 1',
          'description' => 'This is a test project built by Laravel db seeder',
          'role' => 'Dev',
          'type' => 'other',
          'user_id' => $admin_id,
          'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
          'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
      ]);
      DB::table('projects')->insert([
          'title' => 'Test 2',
          'description' => '...This is another test project built by Laravel db seeder...',
          'role' => 'Dev',
          'type' => 'other',
          'user_id' => $admin_id,
          'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
          'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
      ]);
    }
}
