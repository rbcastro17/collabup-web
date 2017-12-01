<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
	protected $table = 'folders';
    protected $fillable = ['name', 'group_id','root_folder_id','container_folder_id','position','ref', 'description'];
}
