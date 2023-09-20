<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Game;

/**
 * Class Team
 *
 * @package App
 * @property string $name
*/
class Department extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

   

    
    

 

}
