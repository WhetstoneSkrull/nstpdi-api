<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{


   public function user() {
   return $this->belongsTo('App\User', 'user_id');
    }

    public function subjectarea() {
    return $this->belongsTo('App\ThematicAreas', 'thematic_areas_id');
     }

   public function options() {
   return $this->hasMany('App\Option');
    }
}
