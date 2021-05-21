<?php
namespace Services\Trip\Handlers;

use Services\Trip\Commands\ListQueryTripCommand;
use Illuminate\Contracts\Validation\Factory as Validation;
use App\Models\Trip;

class ListQueryTripCommandHandler{

  public function __construct(){

  }
  public function handle(ListQueryTripCommand $command) {
      $filters = $command->query;
      $trip = Trip::with('departureCity', 'arrivalCity', 'transport', 'transport.type', 'company');

      $availableFiltes = ['company_uuid', 'departure_city_uuid', 'arrival_city_uuid'];

      foreach ($availableFiltes as $field) {
        if(isset($filters[$field])){
          $trip = $trip->where($field, $filters[$field]);
        }
      }

      if(isset($filters['transport_type_uuid'])){
        $trip->whereHas('transport', function ($query) use($filters){
          return $query->where('type_uuid', $filters['transport_type_uuid']);
        });
      }

      if(isset($filters['after_date'])){
        $trip = $trip->where('departure_date', '>=', $filters['after_date']);
      }

      if(isset($filters['in_date'])){
        $startOfDayTimestamp = strtotime("today",strtotime($filters['in_date']));
        $endOfDayTimestamp   = strtotime("tomorrow", $startOfDayTimestamp) - 1;  

        $trip = $trip->whereBetween('departure_date', [
          date('Y-m-d H:i:s',$startOfDayTimestamp),
          date('Y-m-d H:i:s',$endOfDayTimestamp)
        ]);
      }

      return $trip->paginate();
  } 

  
}