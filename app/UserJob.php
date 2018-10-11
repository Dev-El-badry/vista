<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserJob extends Model
{
    protected $table = 'user_jobs';

    public function user() {
    	return $this->belongsTo('App\PublicUser', 'user_id');
    }

    public function job() {
    	return $this->belongsTo('App\JobTitle', 'job_id');
    }

    public function option() {
    	return $this->belongsTo('App\RequestOption', 'option_id');
    }

}
