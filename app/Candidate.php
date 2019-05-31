<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
     protected $primaryKey = 'candidateId';
     public function schedule() {
          return $this->belongsTo('App\Schedule', 'ScheduleId', 'scheduleId');
     }

     public function availability() {
          return $this->hasOne('App\Availability', 'candidateId', 'candidateId');
     }
}
