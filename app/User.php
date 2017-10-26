<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cmgmyr\Messenger\Traits\Messagable;


class User extends Authenticatable
{
    use Notifiable;
    use Messagable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'image', 'first_name', 'last_name', 'middle_name', 'active', 'role', 'email', 'password', 'code', 'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	
	
	public function information()
	{
		return $this->hasOne('App\User', 'user_id');
	}
}
