<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
  public function module() {
  return $this->belongsTo('App\Module', 'module_id');
   }
   public function user() {
   return $this->belongsTo('App\User', 'user_id');
    }
}
