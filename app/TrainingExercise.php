<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrainingExercise extends Model
{
  public function user() {
  return $this->belongsTo('App\User');
   }

  public function enrolments() {
  return $this->hasMany('App\Enrolment');
   }
}
