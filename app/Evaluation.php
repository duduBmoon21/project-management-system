<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{

    protected $table = 'evaluations';
    protected $primaryKey = 'id';
    protected $fillable = ['acts_id','subst_id','plans_id','userss_id','efficiency','timeliness','quality','accuracy','remarks'];

    public function activity()
    {
        return $this->hasMany('App\Activity' , 'acts_id');
    }


    public function plan()
    {
        return $this->belongsTo('App\Plan','plans_id');
    }

    public function subactivity()
    {
        return $this->hasMany('App\Subactivity' , 'subst_id');
    }

    public function User()
    {
        return $this->belongsTo('App\User');
    }



}
