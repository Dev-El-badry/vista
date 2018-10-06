<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
class PublicUser extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'login_social','sex','age','country','state','address1','address2','telnum','picture','group_id','social_account_title','is_verified'
    ];
}
