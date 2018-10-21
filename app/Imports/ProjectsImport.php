<?php

namespace App\Imports;

use App\Project;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProjectsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      // Don't save if required fields are empty
        if ( !isset($row['title'])
          || !isset($row['description'])
          || !isset($row['role'])
          || !isset($row['type_enum'])) {
          return null;
        }

        $start_date = \Carbon\Carbon::parse($row['start_mmddyyyy']);
        $end_date = \Carbon\Carbon::parse($row['end_mmddyyyy']);

        $user_id = Auth::id();

        $project = new Project([
            'title' => $row['title'],
            'description' => $row['description'],
            'organization' => $row['organization'],
            'start' => $start_date,
            'end' => $end_date,
            'user_id' => $user_id,
            'role' => $row['role'],
            'link' => $row['link'],
            // 'skills_list' => $row['skills_csv'],
            'type' => $row['type_enum'],
        ]);
        $project->save();

        $skill_names = explode(',', $row['skills_csv']);

        foreach ($skill_names as $skill_name) {
          $skill = \App\Skill::createFromInput($skill_name);
          $skill->projects()->attach($project->id);
          $skill->save();
        }


        return $project;
    }
}
