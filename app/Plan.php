<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //
    
    protected $table = 'plans';
    protected $primaryKey = 'id';
    protected $fillable = ['id','name' , 'start_date' , 'end_date','head_id', 'description' , 'status'];

   
    public function activity()
    {
        return $this->hasMany('App\Activity','plan_id');
    }
    public function Progress()
    {
        return $this->hasMany('App\Progress' , 'plnId');
    }
    public function ratings()
    {
        return $this->hasMany('App\Evaluation' , 'plans_id');
    }
    // public function user()
    // {
    //     return $this->belongsTo('App\User');  
    // }

}
