<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarksSetting extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'marks_settings';

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
    protected $fillable = ['exam','class', 'subject', 'theory', 'pass', 'practical'];

    
}
