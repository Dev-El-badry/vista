<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use App\PublicUser;

class BusinessModel extends Model
{
    protected $table = 'business_model';

    // protected $appends = ['user'];
    // public function getUserAttribute() {
    // 	return PublicUser::findOrFail($this->user_id)->first();
    // }

    public function vista_wating() {
    	$instance = $this->hasMany('App\RequestChat', 'bm_id');
    	$instance->where('dr_approve', 0);
    	return $instance;
    }

    public function vista_running() {
    	$instance = $this->hasMany('App\RequestChat', 'bm_id');
    	$instance->where('dr_approve', 1);
    	return $instance;
    }

    public function vista_fails() {
    	$instance = $this->hasMany('App\RequestChat', 'bm_id');
    	$instance->where('dr_approve', 2);
    	return $instance;
    }

    public function vista_done() {
    	$instance = $this->hasMany('App\RequestChat', 'bm_id');
    	$instance->where('dr_approve', 1)->where('cost_pay', 1)->where('closed', 1);
    	return $instance;
    }

    public function user() {
    	return $this->belongsTo('App\PublicUser', 'user_id');
    }
}
