<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    protected $table = 'progresses';
    protected $primaryKey = 'id';
    protected $fillable = ['progress','is_compelete','plnId','acId','subId'];

   
    public function activity()
    {
        return $this->hasMany('App\Activity' , 'plan_id');
    }


    public function plan()
    {
        return $this->belongsTo('App\Plan','start_date');
    }

    public function subactivity()
    {
        return $this->hasMany('App\Subactivity' , 'activ_id');
    }

    public function User()
    {
        return $this->belongsTo('App\User');
    }

}
