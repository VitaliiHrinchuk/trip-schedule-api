<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model 
{

    protected $primaryKey = 'uuid';
    
    protected $keyType = 'string';

    protected $table = 'companies';


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
