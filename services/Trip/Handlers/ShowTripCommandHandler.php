<?php
namespace Services\Trip\Handlers;

use Services\Trip\Commands\ShowTripCommand;
use Illuminate\Contracts\Validation\Factory as Validation;
use App\Models\Trip;

class ShowTripCommandHandler{

  protected $validator;

  public function __construct(Validation $validator){
      $this->validator = $validator;
  }
  public function handle(ShowTripCommand $command) {

      $this->validate($command);

      return Trip::where('uuid', $command->uuid)
                  ->with('departureCity', 'arrivalCity', 'transport', 'company')
                  ->firstOrFail();
  } 

  protected function validate(ShowTripCommand $command) {
    $rules = [
      'uuid' => ['required']
    ];

    $validator = $this->validator->make($command->toArray(), $rules);
    $validator->validate();
  }
}