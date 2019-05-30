<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function schedule() {
        return $this->belongsTo('App\Schedule', 'scheduleId', 'scheduleId');
    }
    
    public function user() {
        return $this->belongsTo('App\User', 'userId');
    }
}
