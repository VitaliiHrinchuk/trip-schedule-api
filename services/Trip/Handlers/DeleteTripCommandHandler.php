<?php
namespace Services\Trip\Handlers;

use Services\Trip\Commands\DeleteTripCommand;
use Illuminate\Contracts\Validation\Factory as Validation;
use App\Models\Trip;

class DeleteTripCommandHandler{

  protected $validator;

  public function __construct(Validation $validator){
      $this->validator = $validator;
  }
  public function handle(DeleteTripCommand $command) {
      $this->validate($command);
      $trip = Trip::where('uuid', $command->uuid)->firstOrFail();

      return $trip->delete();
  } 

  protected function validate(DeleteTripCommand $command) {
    $rules = [
      'uuid' => ['required']
    ];

    $validator = $this->validator->make($command->toArray(), $rules);
    $validator->validate();
  }
}