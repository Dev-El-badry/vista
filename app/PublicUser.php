<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\BusinessModel;

class PublicUser extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'login_social','sex','age','country','state','address1','address2','telnum','picture','group_id','social_account_title','is_verified'
    ];

    protected $appends = ['business_model'];

    public function cd() {
    	return $this->hasOne('App\ChronicDisease', 'user_id');
    }

    public function user_job() {
    	return $this->hasMany('App\UserJob', 'user_id');
    }

    public function notify() {
        return $this->hasMany('App\NotifyAdmin', 'user_id');
    }

    public function getBusinessModelAttribute() {
        return BusinessModel::where("user_id", $this->id)->first();
    }

    public function business_model() {
        return $this->hasOne('App\BusinessModel', 'user_id');
    }
}
