<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

  /**
   * Show the user's profile.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $user = Auth::user();
      if ( !$user->isAdmin() ) {
        return view('user.show', compact('user'));
      }
      $users = User::paginate(20);
      return view('user.index', compact('users'));
  }

  /**
   * Edit user's profile.
   *
   * @return \Illuminate\Http\Response
   */
  public function edit(User $user)
  {
      $this->authorize('users.update', $user);

      return view('user.edit', compact('user'));
  }

  /**
   * Edit user's profile.
   */
  public function update(Request $request, User $user)
  {
      $this->authorize('users.update', $user);

      if ($request->has('avatar')) {
        if (isset($user->avatar) && $user->avatar !== 'default.png') {
          Storage::delete($user->avatar);
        }
        $path = $request->file('avatar')->store('public/avatars');
        $user->avatar = $path;
      }
      $user->name = $request['name'];
      $user->email = $request['email'];
      $user->save();
      return view('user.show', compact('user'))->with('status', 'Successfuly updated!');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Project  $project
   * @return \Illuminate\Http\Response
   */
  public function show(User $user)
  {
      $this->authorize('users.view', $user);

      return view('user.show', compact('user'));
  }

  public function destroy(User $project)
  {
      $this->authorize('users.delete', $user);

      $user->is_active = false;
      $user->save();

      return redirect('projects')->with('status', 'Successfuly deactivated!');
  }
}
