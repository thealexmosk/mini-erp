<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
  /**
   * Show the user's profile.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('profile.index', compact('user'));
  }

  /**
   * Edit user's profile.
   *
   * @return \Illuminate\Http\Response
   */
  public function edit()
  {
      $user = Auth::user();
      return view('profile.edit', compact('user'));
  }

  /**
   * Edit user's profile.
   */
  public function update(Request $request)
  {
      $user = Auth::user();
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
      return redirect('profile')->with('status', 'Successfuly updated!');
  }
}
