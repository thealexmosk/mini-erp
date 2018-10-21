@extends('layouts.user')

@section('content')
  <div class="justify-content-center">
    <div class="card">
      <div class="card-header">Create Skill</div>
      <div class="card-body">
        {!! Form::open(['route' => 'skills.store']) !!}
          <div class="mb-4">
            <div>
              <div class="form-group">
                {{ Form::label('name', 'Name') }}
                {{ Form::text('name', null, ['class' => 'form-control']) }}
              </div>
            </div>
            {{ Form::submit('Create', ['class' => 'btn btn-primary']) }}
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection
