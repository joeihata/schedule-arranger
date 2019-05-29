<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public $primaryKey = 'scheduleId';
    protected $KeyType = 'string';
    public $incrementing = false;
    
    public function users() {
        return $this->belongsTo('App\User', 'createdBy', 'username');
    }

    public function candidates() {
        return $this->hasMany('App\Candidate', 'scheduleId', 'scheduleId');
    }

    public function availabilities() {
        return $this->hasMany('App\Availability', 'scheduleId', 'scheduleId');
    }

    public function comments() {
        return $this->hasMany('App\Comment', 'scheduleId', 'scheduleId');
    }
    protected $fillable = ['scheduleName', 'memo'];
}
