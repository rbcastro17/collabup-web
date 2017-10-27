<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupRequest extends Model
{
    protected $table = 'group_requests';

    protected $fillable = ['user_id', 'group_id', 'created_at', 'updated_at'];
    
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }


    public function group(){
        return $this->belongsTo('App\Group', 'group_id');
    }
}
