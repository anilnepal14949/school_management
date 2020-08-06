<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'attendence';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['class','section','exam','student', 'attendence', 'grade_in_conduct'];
    
}
