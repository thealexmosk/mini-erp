<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const ADMIN_TYPE = 'admin';
    const DEFAULT_TYPE = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
      * Get skill available for this project to select
      */
    public function getAvailSkills() {

        if ($this->isAdmin()) {
          $avail_skills = Skill::all();
        } else {
          $avail_skills = $user->skills()->get();
        }

        $avail_skills = $avail_skills->mapWithKeys(function($skill) {
          return [$skill->id => $skill->name];
        })->toArray();

        $avail_skills[] = '---';

        return $avail_skills;
    }

    /**
     * Check whether the user is admin or not
     */
    public function isAdmin()
    {
      return $this->role === self::ADMIN_TYPE;
    }

    /**
     * Get the post that owns the comment.
     */
    public function projects()
    {
        return $this->hasMany('App\Project');
    }

    /**
     * Get the user's skills.
     */
    public function skills()
    {
        return $this->belongsToMany('App\Skill', 'users_skills');
    }
}
