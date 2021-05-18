<?php
namespace Services\Transport\Handlers;

use Services\Transport\Commands\UpdateTransportCommand;
use Illuminate\Contracts\Validation\Factory as Validation;
use App\Models\Transport;

class UpdateTransportCommandHandler{

  protected $validator;

  public function __construct(Validation $validator){
      $this->validator = $validator;
  }
  public function handle(UpdateTransportCommand $command) {
      $this->validate($command);

      $transport = Transport::where('uuid', $command->uuid)->firstOrFail();
      $transport->name = $command->name;
      $transport->model = $command->model ? $command->model : null;
      $transport->type_uuid = $command->type_uuid;
      $transport->slug = str_replace(' ', '_', $transport->name);

      
      return $transport->save() ? $transport : [] ;
  } 

  protected function validate(UpdateTransportCommand $command) {
    $rules = [
      'name' => ['required', 'string'],
      'type_uuid' => ['required', 'uuid'],
  
      'uuid' => ['required']
    ];  

    $validator = $this->validator->make($command->toArray(), $rules);
    $validator->validate();
  }
}