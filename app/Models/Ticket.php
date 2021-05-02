<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model 
{

    protected $primaryKey = 'uuid';
    
    protected $keyType = 'string';

    protected $table = 'tickets';


    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'price_min', 'price_max', 'available_count', 'type_uuid'
    ];  

    public function trip(){
        return $this->hasOne('App\Models\Trip','uuid', 'trip_uuid');
    }
}
