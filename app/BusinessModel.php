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
}
