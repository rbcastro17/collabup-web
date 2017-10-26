<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $table = 'announcement';
    protected $fillable = ['title','body', 'user_id', 'ref'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
