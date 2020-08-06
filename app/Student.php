<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'students';

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
    protected $fillable = ['class', 'section', 'name', 'roll', 'address', 'date_of_birth', 'house', 'gender', 'age', 'parentName', 'parentContact', 'busStudent', 'disability'];

    
}
