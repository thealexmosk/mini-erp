@extends('layouts.user')

@section('content')
  <div class="justify-content-center">
    <div class="card">
      <div class="card-header">Edit Profile</div>
        <div class="card-body">
          {{ Form::open(['route' => 'profile.update', 'files' => true, 'method' => 'put']) }}
            <div class="form-group">
              {{ Form::label('avatar', 'Profile Photo', ['class' => 'd-block']) }}
              <img class="avatar-edit avatar" src="{{ Storage::url(Auth::user()->avatar) }}"></img>
              {{ Form::file('avatar', ['class' => 'form-control d-inline-block w-auto mw-100']) }}
            </div>
            <div class="form-group">
              {{ Form::label('name', 'Name') }}
              {{ Form::text('name', Auth::user()->name, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
              {{ Form::label('email', 'Email') }}
              {{ Form::text('email', Auth::user()->email, ['class' => 'form-control']) }}
            </div>
              {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
@endsection
