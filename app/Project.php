<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
  const PROJECT_TYPES = [
    'work' => 'Work',
    'book' => 'Book',
    'course' => 'Course',
    'blog' => 'Blog',
    'other' => 'Other',
  ];

  protected $fillable = [
    'title', 'description', 'organization', 'start', 'end', 'role', 'link', 'type', 'user_id'
    ];

  public function getProjectSkillsFormatted() {
    return $this->skills()->get()->mapWithKeys(function($skill) {
      return [$skill->id => $skill->name];
    })->toArray();
  }

  /**
    * The user that own the project
    */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

     /**
      * The skills which are required by the project
      */
      public function skills()
      {
          return $this->belongsToMany('App\Skill', 'projects_skills');
      }
}
