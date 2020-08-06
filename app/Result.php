<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'results';

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
    protected $fillable = ['student','class','section','roll','exam','sub1th','sub1pr','sub2th','sub2pr','sub3th','sub3pr','sub4th','sub4pr','sub5th','sub5pr','sub6th','sub6pr','sub7th','sub7pr','sub8th','sub8pr','sub9th','sub9pr','sub10th','sub10pr','sub11th','sub11pr','sub12th','sub12pr','sub13th','sub13pr','sub14th','sub14pr','sub15th','sub15pr','sub16th','sub16pr','sub17th','sub17pr'];
}
