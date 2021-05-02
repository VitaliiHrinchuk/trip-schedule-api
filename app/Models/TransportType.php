<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransportType extends Model 
{

    protected $primaryKey = 'uuid';
    
    protected $keyType = 'string';

    protected $table = 'transport_types';


    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'slug'
    ];  
}
