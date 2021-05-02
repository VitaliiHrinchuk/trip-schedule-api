<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transport extends Model 
{

    protected $primaryKey = 'uuid';
    
    protected $keyType = 'string';

    protected $table = 'transports';


    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'name', 'slug', 'model', 'type_uuid'
    ];  

    public function type(){
        return $this->hasOne('App\Models\TransportType','uuid', 'type_uuid');
    }
}
