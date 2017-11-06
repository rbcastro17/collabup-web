<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppNotification extends Model
{
  public $fillable = ['user_id', 'reciever_id', 'ref', 'group_id','type'];
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function event(){
        return $this->belongsTo('App\Event', 'ref');
    }

    public function announcement(){
        return $this->belongsTo('App\Announcement', 'ref');
    }

    public function group(){
        return $this->belongsTo('App\Group', 'group_id');
    }

    
}

