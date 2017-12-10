<?php
namespace App;

use Illuminate\Database\Eloquent\Model;


class Event extends Model 
{
    protected $table = 'events';

    protected $fillable = ['group_id', 'event_author', 'start_duration', 'end_duration', 'title', 'body', 'ref'];

    public function group(){   
        return $this->belongsTo('App\Group', 'group_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'event_author');
    }
}
