<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model 
{

    protected $primaryKey = 'uuid';
    
    protected $keyType = 'string';

    protected $table = 'cities';


    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'name'
    ];  
}
