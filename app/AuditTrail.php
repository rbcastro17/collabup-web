<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
    protected $table = 'audit_trails';

    protected $fillable = ['user_id', 'description','url'];

    public function user(){

        return $this->belongsTo('App\User', 'user_id');
    }
}
