<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    protected $primaryKey = 'candidateId';
    public function user() {
        return $this->belongsTo('App\User', 'userId');
    }

    public function candidate() {
        return $this->belongsTo('App\Candidate', 'candidateId');
    }
}
