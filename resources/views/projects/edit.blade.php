@extends('layouts.user')

@section('content')
  <div class="justify-content-center">
    <div class="card">
      <div class="card-header">Edit Project</div>
        <div class="card-body">
          {{ Form::open(['route' => ['projects.update', $project], 'method' => 'put']) }}
            <div class="form-group">
              {{ Form::label('title', 'Title') }}
              {{ Form::text('title', $project->title, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
              {{ Form::label('description', 'Description') }}
              {{ Form::text('description', $project->description, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
              {{ Form::label('organization', 'Organization') }}
              {{ Form::text('organization', $project->organization, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
              {{ Form::label('start', 'Start Date') }}
              {{ Form::date('start', $project->start, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
              {{ Form::label('end', 'End Date') }}
              {{ Form::date('end', $project->end, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
              {{ Form::label('role', 'Role') }}
              {{ Form::text('role', $project->role, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
              {{ Form::label('link', 'Link') }}
              {{ Form::text('link', $project->link, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
              {{ Form::label('skills[]', 'Skills') }}
              {{ Form::select('skills[]', $avail_skills, array_keys($projects_skills), ['class' => 'form-control', 'multiple' => 'multiple']) }}
            </div>
            <div class="form-group">
              {{ Form::label('type', 'Type') }}
              {{ Form::select('type', $project_types, $project->type, ['class' => 'form-control']) }}
            </div>
              {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
@endsection
