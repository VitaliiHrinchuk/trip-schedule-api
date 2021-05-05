<?php
namespace Services\Transport\Handlers;

use Services\Transport\Commands\DeleteTransportCommand;
use Illuminate\Contracts\Validation\Factory as Validation;
use App\Models\Transport;

class DeleteTransportCommandHandler{

  protected $validator;

  public function __construct(Validation $validator){
      $this->validator = $validator;
  }
  public function handle(DeleteTransportCommand $command) {
      $this->validate($command);
      $transport = Transport::where('uuid', $command->uuid)->firstOrFail();

      return $transport->delete();
  } 

  protected function validate(DeleteTransportCommand $command) {
    $rules = [
      'uuid' => ['required']
    ];

    $validator = $this->validator->make($command->toArray(), $rules);
    $validator->validate();
  }
}