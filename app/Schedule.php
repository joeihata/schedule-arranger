<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public $primaryKey = 'scheduleId';

    protected $KeyType = 'string';

    public $incrementing = false;
    
    public function user() {
        return $this->belongsTo('App\User', 'createdBy', 'username');
    }

    public function candidate() {
        return $this->hasMany('App\Candidate', 'scheduleId', 'scheduleId');
    }

    public function availability() {
        return $this->hasMany('App\Availability', 'scheduleId', 'scheduleId');
    }

    public function comment() {
        return $this->hasMany('App\Comment', 'scheduleId', 'scheduleId');
    }

    protected $fillable = ['scheduleName', 'memo'];
}
