<?php
namespace Services\TransportType\Handlers;

use Services\TransportType\Commands\DeleteTransportTypeCommand;
use Illuminate\Contracts\Validation\Factory as Validation;
use App\Models\TransportType;

class DeleteTransportTypeCommandHandler{

  protected $validator;

  public function __construct(Validation $validator){
      $this->validator = $validator;
  }
  public function handle(DeleteTransportTypeCommand $command) {
      $this->validate($command);
      $company = TransportType::where('uuid', $command->uuid)->firstOrFail();

      return $company->delete();
  } 

  protected function validate(DeleteTransportTypeCommand $command) {
    $rules = [
      'uuid' => ['required']
    ];

    $validator = $this->validator->make($command->toArray(), $rules);
    $validator->validate();
  }
}