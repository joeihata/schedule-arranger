<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
     protected $primaryKey = 'candidateId';
     public function schedule() {
          return $this->belongsTo('App\Schedule', 'ScheduleId', 'scheduleId');
     }

     public function availabilities() {
          return $this->hasMany('App\Availability', 'candidateId', 'candidateId');
     }
}
