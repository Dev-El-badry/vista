<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotifyAdmin extends Model
{
    protected $table = 'notify_admin';

    public function user() {
    	return $this->belongsTo('App\PublicUser', 'user_id');
    }

    public function job() {
    	return $this->belongsTo('App\JobTitle', 'job_id');
    }
}
