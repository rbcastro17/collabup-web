<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
     protected $fillable = [
         'group_id',
        'group_name', 
        'code',
         'description',
        'type',
         'group_owner',
          'hasChat',
          'category_id'
    ];
    
    public function user(){
        return $this->belongsTo('App\User', 'group_owner');
    }


    public function category(){
        return $this->belongsTo('App\Category', 'category_id');
    }
}
