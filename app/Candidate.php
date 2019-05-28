<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
     public function schedule() {
          return $this->belongsTo('App\Schedule', 'ScheduleId', 'scheduleId');
     }

     public function availability() {
          return $this->hasMany('App\availability', 'candidateId', 'candidateId');
     }
}
