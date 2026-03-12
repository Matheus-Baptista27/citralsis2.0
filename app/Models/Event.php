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

    public function getStartTimeFormattedAttribute()
    {
        return $this->start_time ? substr($this->start_time, 0, 5) : null;
    }

    public function getEndTimeFormattedAttribute()
    {
        return $this->end_time ? substr($this->end_time, 0, 5) : null;
    }

    public function getDateFormattedAttribute()
    {
        return \Carbon\Carbon::parse($this->date)->format('d/m/Y');
    }

}
