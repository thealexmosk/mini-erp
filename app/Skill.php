<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Skill extends Model
{
  public $timestamps = false;

  public static function createFromInput($skill_name) {
      $user_id = Auth::id();
      $skill_name = strtolower($skill_name);
      $skill = Skill::where('name', 'LIKE', $skill_name);

      if ( !$skill->exists()) {
        $skill = new Skill;
        $skill->name = $skill_name;
        $skill->save();
      } else {
        $skill = $skill->first();
      }

      $skill->users()->attach($user_id);
      $skill->save();

      return $skill;
  }
  /**
   * The users that have the skill
   */
   public function users()
   {
       return $this->belongsToMany('App\User', 'users_skills');
   }

   /**
    * The projects that require the skill
    */
    public function projects()
    {
        return $this->belongsToMany('App\Project', 'projects_skills');
    }

    /**
     * The projects that require the skill of the current user
     */
     public function users_projects($user_id)
     {
         return $this->belongsToMany('App\Project', 'projects_skills')->where('user_id', '=', $user_id);
     }
}
