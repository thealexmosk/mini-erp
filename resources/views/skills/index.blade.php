@extends('layouts.user')

@section('content')
  <div class="justify-content-center">
    <div class="card">
      <div class="card-header">My skills</div>
      <div class="card-body">
        @if (session('status'))
          <div class="alert alert-success" role="alert">
              {{ session('status') }}
          </div>
        @endif
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Projects</th>
              <th scope="col" class="nostretch">Action</th>
            </tr>
          </thead>
          <tbody>
          @foreach (Auth::user()->skills as $skill)
            <tr>
              <th class="align-middle" scope="row">{{ $loop->iteration }}</th>
              <td class="align-middle font-weight-bold">{{ $skill->name }}</td>
              <td class="align-middle">
                @foreach ($skill->users_projects(Auth::id())->get() as $project)
                  <a href="{{ route("projects.show", $project->id) }}" class="btn btn-outline-success" role="button">{{ $project->title }}</a>
                @endforeach
              </td>
              <td>
                {!! Form::open(['route' => ["skills.destroy", $skill], 'method' => 'DELETE', 'class' => 'd-inline-block']) !!}
	              {{ Form::submit('Remove', ['class' => 'btn btn-outline-danger', 'onClick' => 'return confirm("Are you sure?")']) }}
	              {!! Form::close() !!}
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
        <a href="{{ route("skills.create") }}" class="btn btn-primary" role="button">Add Skill</a>
      </div>
    </div>
  </div>
@endsection
