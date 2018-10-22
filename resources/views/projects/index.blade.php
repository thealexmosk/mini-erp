@extends('layouts.user')

@section('scripts')
    <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
@endsection

@section('content')
  <div class="justify-content-center">
    <div class="card">
      <div class="card-header">All Projects</div>
      <div class="card-body">
        @if (session('status'))
          <div class="alert alert-success" role="alert">
              {{ session('status') }}
          </div>
        @endif
        <div class="projects__filters mb-3">
          {!! Form::open(['route' => $route_name, 'id' => 'filterForm']) !!}
          <div class="container">
            <div class="row">
              <div class="col-12 col-md-2 mb-1">
                {{ Form::label('title', 'Filter:', ['class' => 'form-control font-weight-bold border-0']) }}
              </div>
              <div class="col-6 col-md-3 mb-1">
                {{ Form::text('title', $filters['title'], ['class' => 'form-control', 'placeholder' => 'Title']) }}
              </div>
              <div class="col-6 col-md-3 mb-1">
                {{ Form::text('organization', $filters['organization'], ['class' => 'form-control', 'placeholder' => 'Organization']) }}
              </div>
              <div class="col-6 col-md-2 mb-1">
                {{ Form::select('type', $project_types, $filters['type'], ['class' => 'form-control']) }}
              </div>
              <div class="col-6 col-md-2 mb-1">
                {{ Form::hidden('route', $route_name) }}
                {{ Form::submit('Search', ['class' => 'btn btn-outline-primary w-100']) }}
              </div>
            </div>
          </div>

          {!! Form::close() !!}
        </div>
        <div class="scrollmenu projects__table">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Organization</th>
                <th scope="col">Type</th>
                <th scope="col">User</th>
                <th scope="col">Role</th>
                <th scope="col" >Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($projects as $project)
              <tr class="tr-align-middle">
                <th scope="row">{{ $loop->iteration}}</th>
                <td>{{ $project->title }}</td>
                <td>{{ $project->organization ?? "---" }}</td>
                <td>{{ $project->type }}</td>
                <td>{{ $project->user()->first()->name }}</td>
                <td>{{ $project->role }}</td>
                <td>
                  <a href="{{ route("projects.show", $project->id) }}" class="btn btn-outline-primary" role="button">Show</a>
                  @can('projects.update', $project)
                    <a href="{{ route("projects.edit", $project->id) }}" class="btn btn-outline-warning" role="button">Edit</a>
                    {!! Form::open(['route' => ["projects.destroy", $project], 'method' => 'DELETE', 'class' => 'd-inline-block']) !!}
    	              {{ Form::submit('Remove', ['class' => 'btn btn-outline-danger', 'onClick' => 'return confirm("Are you sure?")']) }}
    	              {!! Form::close() !!}
                  @endcan
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="pagination-nav mt-3">
            {{ $projects->links() }}
          </div>
        </div>

        <div class="container mt-2">
          <div class="row justify-content-end">
            <a href="{{ route("projects.exportProjects") }}" class="btn btn-outline-success" role="button">Export to Excel</a>
          </div>
          <hr>
          <div class="row">
            <div class="col-8">
              {!! Form::open(['route' => ["projects.importProjects", $export_user_id], 'files' => true, 'class' => 'd-inline-block']) !!}
              {{ Form::label('project_file', 'Import Projects (Excel)') }}
              {{ Form::file('project_file', [
                'class' => 'form-control d-inline-block',
                'style' => 'width: 120px',
                'onchange' => 'this.form.submit()'
                ]) }}
              {!! Form::close() !!}
            </div>
            <div class="col-4">
              <a href="{{ route("projects.create") }}" class="btn btn-primary float-right" role="button">Add Project</a>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
@endsection

@section('custom_scripts')
   <script>
     $(function() {
       $('#filterForm').submit(function( e ) {
          e.preventDefault();
          $.ajax({
            url: "{{route('projects.ajaxProjects')}}",
            type: 'post',
            data: {data: $('#filterForm').serialize()},
            headers: {
              'X-CSRF-TOKEN': $('#filterForm input[name="_token"]').val()
            },
            success: function( data ) {
              $('.projects__table').html(data);
            }

          });
        });
      });
    </script>
@endsection
