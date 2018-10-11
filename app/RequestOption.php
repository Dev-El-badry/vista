<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestOption extends Model
{
    protected $table = 'request_options';

    public function user_job() {
    	return $this->hasOne('App\UserJob', 'option_id');
    }
}
