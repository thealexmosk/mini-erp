<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Organization</th>
      <th scope="col">Type</th>
      <th scope="col">User</th>
      <th scope="col">Role</th>
      <th scope="col">Actions</th>
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
{{-- <div class="pagination-nav mt-3">
  {{ $projects->links() }}
</div> --}}
