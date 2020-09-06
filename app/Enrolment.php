<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrolment extends Model
{
  public function user() {
  return $this->belongsTo('App\User');
   }
}
