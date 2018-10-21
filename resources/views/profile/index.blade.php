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
          <div class="row">
            <div class="col-sm-5">
              <img class="profile__avatar user__avatar avatar" src="{{ Storage::url(Auth::user()->avatar) }}"></img>
            </div>
            <div class="col-sm-7 mt-2">
              <div class="profile__name">
                {{ Auth::user()->name }}
              </div>
              <div class="profile__email">
                {{ Auth::user()->email }}
              </div>
            </div>
          </div>
          <a href="{{ route("profile.edit") }}" class="btn btn-primary float-right" role="button">Edit</a>
        </div>
        </div>
      </div>
    </div>
  </div>
@endsection
