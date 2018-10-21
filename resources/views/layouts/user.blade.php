@extends('layouts.app')

@section('main')
  <div class="container-fluid h-100">
    <div class="row h-100">
      <aside class="col-2 col-sm-3 p-0 navbar-dark bg-dark" >
          <nav class="navbar navbar-expand navbar-light flex-md-column flex-row align-items-start py-2">
              <div class="collapse navbar-collapse">
                  <ul class="flex-column flex-row navbar-nav w-100 justify-content-between">
                    @if (Auth::user()->isAdmin())
                      <li class="nav-item">
                          <a class="nav-link pl-0 text-nowrap" href="#">
                            <i class="fa fa-users fa-fw"></i>
                            <span class="d-none d-sm-inline font-weight-bold">All Users</span>
                          </a>
                      </li>
                    @endif
                      <li class="nav-item">
                          <a class="nav-link pl-0 text-nowrap" href="{{ route('profile') }}"><i class="fa fa-user fa-fw"></i> <span class="d-none d-sm-inline font-weight-bold">Profile</span></a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link pl-0 text-nowrap" href="{{ route('projects.index') }}"><i class="fa fa-globe fa-fw"></i> <span class="d-none d-sm-inline font-weight-bold">All Projects</span></a>
                      </li>
                      {{-- <li class="nav-item">
                          <a class="nav-link pl-0" href="{{ route('projects.index') }}"><i class="fa fa-star fa-fw"></i> <span class="d-none d-sm-inline">My Projects</span></a>
                      </li> --}}
                      <li class="nav-item">
                          <a class="nav-link pl-0" href="{{ route('skills.index') }}"><i class="fa fa-book fa-fw"></i> <span class="d-none d-sm-inline">My Skills</span></a>
                      </li>
                  </ul>
              </div>
          </nav>
      </aside>
      <main class="col-10 col-sm-9 py-4">
        @yield('content')
      </main>
    </div>
  </div>
@endsection
