@extends('layouts.user')

@section('content')
  <div class="justify-content-center">
    <div class="card">
      <div class="card-header">Create Project</div>
      <div class="card-body">
        {{ Form::open(['route' => 'projects.store']) }}
          <div class="mb-4">
            <div>
              <div class="form-group">
                {{ Form::label('title', 'Title') }}
                {{ Form::text('title', null, ['class' => 'form-control']) }}
              </div>
              <div class="form-group">
                {{ Form::label('description', 'Description') }}
                {{ Form::textarea('description', null, ['class' => 'form-control']) }}
              </div>
              <div class="form-group">
                {{ Form::label('organization', 'Organization') }}
                {{ Form::text('organization', null, ['class' => 'form-control']) }}
              </div>
              <div class="form-group">
                {{ Form::label('start', 'Start Date') }}
                {{ Form::date('start', null, ['class' => 'form-control']) }}
              </div>
              <div class="form-group">
                {{ Form::label('end', 'End Date') }}
                {{ Form::date('end', \Carbon\Carbon::now(), ['class' => 'form-control']) }}
              </div>
              <div class="form-group">
                {{ Form::label('role', 'Role') }}
                {{ Form::text('role', null, ['class' => 'form-control']) }}
              </div>
              <div class="form-group">
                {{ Form::label('link', 'Resource URL') }}
                {{ Form::text('link', null, ['class' => 'form-control']) }}
              </div>
              <div class="form-group">
                {{ Form::label('skills[]', 'Skills') }}
                {{ Form::select('skills[]', $avail_skills, null, ['class' => 'form-control', 'multiple' => 'multiple']) }}
              </div>
              <div class="form-group">
                {{ Form::label('type', 'Type') }}
                {{ Form::select('type', $project_types, null, ['class' => 'form-control']) }}
              </div>
            </div>
          </div>
          {{ Form::submit('Create', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}
      </div>
    </div>
  </div>
@endsection
