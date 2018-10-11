<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestChat extends Model
{
    public function bm() {
    	return $this->belongsTo('BusinessModel', 'bm_id');
    }
}
