<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model 
{

    protected $primaryKey = 'uuid';
    
    protected $keyType = 'string';

    protected $table = 'trips';


    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'seats', 'departure_date', 'return_date', 'company_uuid', 
        'departure_city_uuid', 'arrival_city_uuid', 'transport_uuid'
    ];  

    public function departureCity(){
        return $this->hasOne('App\Models\City','uuid', 'departure_city_uuid');
    }

    public function arrivalCity(){
      return $this->hasOne('App\Models\City','uuid', 'arrival_city_uuid');
    }

    public function transport(){
      return $this->hasOne('App\Models\Transport','uuid', 'transport_uuid');
    }

    public function company(){
      return $this->hasOne('App\Models\Company','uuid', 'company_uuid');
    }
}
