<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subactivity extends Model
{
    protected $fillable = ['name','start_date','end_date','description','Status','activ_id','empl_id'];

    public function setempl_idAttribute($value)
    {
        $this->attributes['empl_id'] = json_encode($value);
    }
  
    
    public function getempl_idAttribute($value)
    {
        return $this->attributes['empl_id'] = json_decode($value);
    }




    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function Progress()
    {
        return $this->hasMany('App\Progress' ,'subId');
    }
    public function ratings()
    {
        return $this->hasMany('App\Evaluation' , 'subst_id');
    }
}
