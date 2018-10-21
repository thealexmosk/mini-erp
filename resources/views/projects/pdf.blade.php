<!DOCTYPE html>
<html>
  <table class="table">
    <tbody>
      <tr>
        <th scope="row">Title</th>
        <td>{{ $project->title }}</td>
      </tr>
      <tr>
        <th scope="row">Description</th>
        <td>{{ $project->description }}</td>
      </tr>
      <tr>
        <th scope="row">Organization</th>
        <td>{{ $project->organization }}</td>
      </tr>
      <tr>
        <th scope="row">Start</th>
        <td>{{ $project->start }}</td>
      </tr>
      <tr>
        <th scope="row">End</th>
        <td>{{ $project->end }}</td>
      </tr>
      <tr>
        <th scope="row">Name</th>
        <td>{{ $project->user->name }}</td>
      </tr>
      <tr>
        <th scope="row">Role</th>
        <td>{{ $project->role }}</td>
      </tr>
      <tr>
        <th scope="row">Link</th>
        <td>{{ $project->link }}</td>
      </tr>
      <tr>
        <th scope="row">Skills</th>
        <td>
          @foreach ($project->skills()->get() as $skill)
            <button class="btn btn-outline-success" type="button">{{ $skill->name }}</button>
          @endforeach
        </td>
      </tr>
      <tr>
        <th scope="row">Type</th>
        <td>{{ $project->type }}</td>
      </tr>
      <tr>
        <th scope="row">Created</th>
        <td>{{ $project->created_at }}</td>
      </tr>
      <tr>
        <th scope="row">Updated</th>
        <td>{{ $project->updated_at }}</td>
      </tr>
    </tbody>
  </table>
</html>
