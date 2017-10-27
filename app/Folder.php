<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
	protected $table = 'folders';
    protected $fillable = ['name', 'group_id', 'description'];
}
