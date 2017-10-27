<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
	public function user(){
		return $this->hasOne('App\User');
	}
	
    protected $fillable = [
		'birthday', 'contact_no', 'occupation', 'primary', 'secondary', 'tertiary', 'user_id'
	];
}
