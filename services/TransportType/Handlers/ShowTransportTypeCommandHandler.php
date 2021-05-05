<?php
namespace Services\TransportType\Handlers;

use Services\TransportType\Commands\ShowTransportTypeCommand;
use Illuminate\Contracts\Validation\Factory as Validation;
use App\Models\TransportType;

class ShowTransportTypeCommandHandler{

  protected $validator;

  public function __construct(Validation $validator){
      $this->validator = $validator;
  }
  public function handle(ShowTransportTypeCommand $command) {

      $this->validate($command);

      return TransportType::where('uuid', $command->uuid)->firstOrFail();
  } 

  protected function validate(ShowTransportTypeCommand $command) {
    $rules = [
      'uuid' => ['required']
    ];

    $validator = $this->validator->make($command->toArray(), $rules);
    $validator->validate();
  }
}