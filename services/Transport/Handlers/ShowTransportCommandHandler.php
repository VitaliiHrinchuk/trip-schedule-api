<?php
namespace Services\Transport\Handlers;

use Services\Transport\Commands\ShowTransportCommand;
use Illuminate\Contracts\Validation\Factory as Validation;
use App\Models\Transport;

class ShowTransportCommandHandler{

  protected $validator;

  public function __construct(Validation $validator){
      $this->validator = $validator;
  }
  public function handle(ShowTransportCommand $command) {

      $this->validate($command);

      return Transport::where('uuid', $command->uuid)->with('type')->firstOrFail();
  } 

  protected function validate(ShowTransportCommand $command) {
    $rules = [
      'uuid' => ['required']
    ];

    $validator = $this->validator->make($command->toArray(), $rules);
    $validator->validate();
  }
}