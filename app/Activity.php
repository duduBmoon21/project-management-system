<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';
    protected $primaryKey = 'id';
    protected $fillable = ['name','start_date','end_date','description','Status','plan_id'];

  public function plan()
    {
        return $this->belongsTo('App\Plan');
    }
    public function ratings()
    {
        return $this->hasMany('App\Evaluation' ,'acts_id');
    }

    public function Progress()
    {
        return $this->hasMany('App\Progress' , 'acId');
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
