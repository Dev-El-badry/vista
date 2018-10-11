<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobTitle extends Model
{
    public function identity_job() {
    	return $this->hasMany('App\JobIdentity', 'job_id');
    }

    public function user_job() {
    	return $this->hasMany('App\UserJob', 'job_id');
    }

     public function notify() {
        return $this->hasMany('App\NotifyAdmin', 'job_id');
    }
}
