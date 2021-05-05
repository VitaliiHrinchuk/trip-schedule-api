<?php
namespace Services\Trip\Handlers;

use Services\Trip\Commands\UpdateTripCommand;
use Illuminate\Contracts\Validation\Factory as Validation;
use App\Models\Trip;

class UpdateTripCommandHandler{

  protected $validator;

  public function __construct(Validation $validator){
      $this->validator = $validator;
  }
  public function handle(UpdateTripCommand $command) {
      $this->validate($command);

      $trip = Trip::where('uuid', $command->uuid)->firstOrFail();
      $trip->departure_date = $command->departure_date;
      $trip->return_date = $command->return_date ? $command->return_date : null;
      $trip->seats = $command->seats;
      $trip->company_uuid = $command->company_uuid;
      $trip->departure_city_uuid = $command->departure_city_uuid;
      $trip->arrival_city_uuid = $command->arrival_city_uuid;
      $trip->transport_uuid = $command->transport_uuid;

      
      return $trip->save() ? $trip->with('departureCity', 'arrivalCity', 'transport', 'company')->first() : [] ;
  } 

  protected function validate(UpdateTripCommand $command) {
    $rules = [
      'departure_date' => ['required', 'date'],
      'return_date' => ['date', 'after:departure_date'],
      'seats' => ['required', 'integer'],
      'company_uuid' => ['required', 'uuid'],
      'departure_city_uuid' => ['required', 'uuid'],
      'arrival_city_uuid' => ['required', 'uuid'],
      'transport_uuid' => ['required', 'uuid'],
    ];

    $validator = $this->validator->make($command->toArray(), $rules);
    $validator->validate();
  }
}