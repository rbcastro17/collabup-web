<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
      protected $table = 'members';
      protected $fillable = [ 'group_id',  'email', 'user_id'];
   
   
    public function group(){   
        return $this->belongsTo('App\Group', 'group_id');
    }



    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
