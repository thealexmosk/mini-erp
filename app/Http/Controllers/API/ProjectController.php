<?php

namespace App\Http\Controllers\API;

use App\Project;
use App\Skill;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        $projects->map(function ($project) {
          if ($project->hasSkills()) {
            $skills_array = $project->skills->map(function($skill) {
              return $skill->name;
            })->toArray();
            $skills_array = implode(',', $skills_array);
            $project['skills_array'] = $skills_array;
          }
          return $project;
        });

        return $projects;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['user_id'] = Auth::id();
        $project = Project::create($data);

        if ($data['skills']) {
          $skills_names = explode(',', $data['skills']);

          foreach ($skills_names as $skill_name) {
            $skill = Skill::addBySkillName('skill_name');
            $project->skills()->attach($skill->id);
          }
        }

        return $project;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);

        if ($project->hasSkills()) {
          $skills_array = $project->skills->map(function($skill) {
            return $skill->name;
          })->toArray();

          $skills_array = implode(',', $skills_array);
          $project['skills_array'] = $skills_array;
        }

        return $project;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('projects.update', $project);

        $user = Auth::user();
        $data = $request->except('_token');
        $data['user_id'] = Auth::id();

        $project->skills()->detach();

        if ($data['skills'] && $data['skills'][0] != '0') {
          $project->skills()->attach($data['skills']);
          $user->skills()->syncWithoutDetaching($data['skills']);
        }

        $project->fill($data)->save();

        return $project;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $project->skills()->detach();
        $project->users()->detach();
        $project->delete();

        return 204;
    }
}
