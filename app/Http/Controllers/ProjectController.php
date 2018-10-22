<?php

namespace App\Http\Controllers;

use App\Project;
use App\Skill;
use PDF;
use App\Imports\ProjectsImport;
use App\Exports\ProjectsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $route_name = Route::currentRouteName();
        $export_user_id = null;

        if ($route_name === 'projects.my') {
          $export_user_id = Auth::id();
          $projects = Project::where('user_id', '=', $export_user_id);
        } else {
          $projects = Project::query();
        }

        $filters = [
          'title' => '',
          'organization' => '',
          'type' => '0'
        ];

        if ($request->has('title')) {
          $filters['title'] = $request->title;
          $projects = $projects->where('title', 'LIKE', "%{$request->title}%");
        }

        if ($request->has('organization')) {
          $filters['organization'] = $request->organization;
          $projects = $projects->where('title', 'LIKE', "%{$request->organization}%");
        }

        if ($request->has('type') && $request->type !== "0") {
          $filters['type'] = $request->type;
          $projects = $projects->where('type', '=', $request->type);
        }

        $project_types = Project::PROJECT_TYPES;
        $project_types[0] = 'All Types';

        $projects = $projects->paginate(15);

        return view('projects.index', compact('projects', 'project_types', 'filters', 'route_name', 'export_user_id'));
    }

    public function ajaxProjects(Request $request)
    {
      parse_str($request['data'], $data);

      $export_user_id = null;

      if ($data['route'] === 'projects.my') {
        $export_user_id = Auth::id();
        $projects = Project::where('user_id', '=', $export_user_id);
      } else {
        $projects = Project::query();
      }

      if ($data['title']) {
        $projects = $projects->where('title', 'LIKE', "%{$data['title']}%");
      }
      if ($data['organization']) {
        $projects = $projects->where('title', 'LIKE', "%{$data['organization']}%");
      }

      if ($data['type'] && $data['type'] !== "0") {
        $projects = $projects->where('type', '=', $data['type']);
      }

      // $projects = $projects->paginate(2);
      $projects = $projects->get();

      return view('projects.ajax_projects', compact('projects'))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $project_types = Project::PROJECT_TYPES;
        $avail_skills = $user->getAvailSkills();

        return view('projects.create', compact('project_types', 'avail_skills'));
    }

    public function importProjects(Request $request)
    {
        $user = Auth::user();
        Excel::import(new ProjectsImport, $request->file('project_file'));

        return redirect('projects')->with('status', 'Successfuly created!');
    }

    public function exportProjects($user_id = null)
    {
        return Excel::download(new ProjectsExport($user_id), 'projects.xlsx');
    }

    public function downloadPDF($project_id)
    {
        $project = Project::find($project_id);
        $pdf = PDF::loadView('projects.pdf', compact('project'));
        return $pdf->download("{$project->title}.pdf");
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
          $project->skills()->attach($data['skills']);
        }

        return redirect('projects')->with('status', 'Successfuly created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $this->authorize('projects.update', $project);

        $user = Auth::user();
        $project_types = Project::PROJECT_TYPES;
        $projects_skills = $project->getProjectSkillsFormatted();
        $avail_skills = $user->getAvailSkills();

        return view('projects.edit', compact('project', 'project_types', 'projects_skills', 'avail_skills'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $this->authorize('projects.update', $project);

        $user = Auth::user();
        $data = $request->except('_token');
        $data['user_id'] = Auth::id();

        if ($data['skills']) {
          $project->skills()->sync($data['skills']);
          $user->skills()->sync($data['skills']);
        }

        $project->fill($data)->save();

        return redirect('projects')->with('status', 'Successfuly updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->skills()->detach();
        $project->delete();

        return redirect('projects')->with('status', 'Successfuly deleted!');
    }
}
