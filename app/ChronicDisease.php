<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChronicDisease extends Model
{
    public function user() {
    	return $this->belongsTo('App\PublicUser', 'user_id');
    }
}
