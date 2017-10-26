<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    protected $table = 'files';


    public function user()
    {
        return $this->belongsTo('App\User', 'file_owner');
    }
}
