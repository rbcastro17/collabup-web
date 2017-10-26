<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
   protected $fillable = [
       'post_id', 'user_id', 'body', 'group_id' 
   ];

   public function post()
   {
       return $this->hasOne('App\Post', 'post_id');
   }

   public function user()
   {
       return $this->belongsTo('App\User', 'user_id');
   }
}
