<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    protected $guarded = [];

    //USUARIO QUE É DONO DO EVENTO, PERTENCE A 1 USUARIO
    public function user() {
        return $this->belongsTo('App\Models\User');
    }



}
