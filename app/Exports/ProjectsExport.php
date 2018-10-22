<?php

namespace App\Exports;

use App\Project;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProjectsExport implements FromCollection
{
    protected $user_id;

    public function __construct($user_id = null) {
      if ($user_id) {
        $this->user_id = $user_id;
      }
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
      $import_projects = [
        ['Title*', 'Description*', 'Organization', 'Start Date', 'End Date', 'Role*', 'Link', 'Type* (ENUM)', 'Skills (CSV)', 'User']
      ];
      $all_projects = Project::get()->map(function($project) {

        if ($this->user_id) {
          $project = $project->where('user_id', '=', $this->user_id);
        }

        $res = $project->only(['title', 'description', 'organization', 'start', 'end', 'role', 'link', 'type']);

        $skills = $project->skills->map(function($skill) {
          return $skill->name;
        })->toArray();

        $res['skills'] = implode(',', $skills);
        $res['user'] = $project->user->name;

        return $res;
      })->toArray();

      $projects = collect(array_merge($import_projects, $all_projects));

      return $projects;
    }
}
