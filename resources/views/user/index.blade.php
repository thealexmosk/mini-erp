@extends('layouts.user')

@section('content')
  <div class="justify-content-center">
    <div class="card">
      <div class="card-header">Profile</div>
      <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="container profile">
          <div class="scrollmenu">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">User</th>
                  <th scope="col">Active</th>
                  <th scope="col">Email</th>
                  <th scope="col">Skills</th>
                  <th scope="col">Projects</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                <tr class="tr-align-middle">
                  <th scope="row">{{ $loop->iteration}}</th>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->is_active ? 'Yes' : 'No'}}</td>
                  <td>{{ $user->email }}</td>
                  <td>
                    @foreach ($user->skills as $skill)
                      {{ $skill->name }}
                    @endforeach
                  </td>
                  <td>
                    @foreach ($user->projects as $project)
                      <a href="{{ route("projects.show", $project->id) }}" class="btn btn-outline-success" role="button">{{ $project->title }}</a>
                    @endforeach
                  </td>
                  <td>
                    <a href="{{ route("user.show", $user) }}" class="btn btn-outline-primary" role="button">Show</a>
                    <a href="{{ route("user.edit", $user) }}" class="btn btn-outline-warning" role="button">Edit</a>
                    {!! Form::open(['route' => ["user.destroy", $user], 'method' => 'DELETE', 'class' => 'd-inline-block']) !!}
    	              {{ Form::submit('Deactivate', ['class' => 'btn btn-outline-danger', 'onClick' => 'return confirm("Are you sure?")']) }}
    	              {!! Form::close() !!}
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          {{ $users->links() }}
        </div>
        </div>
      </div>
    </div>
  </div>
@endsection
