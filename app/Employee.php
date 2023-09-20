<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Employee
 *
 * @package App
 * @property string $department
 * @property string $name
 *  @property string $surname
 * @property string $email
  * @property string $password

 * @property string $birth_date
*/
class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = ['name','surname','email','password','birth_date', 'dept_id'];
    

    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id')->withTrashed();
    }
    
}
