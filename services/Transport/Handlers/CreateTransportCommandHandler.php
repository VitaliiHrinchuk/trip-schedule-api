<?php
namespace Services\Transport\Handlers;

use Services\Transport\Commands\CreateTransportCommand;
use Illuminate\Contracts\Validation\Factory as Validation;
use App\Models\Transport;

class CreateTransportCommandHandler{

  protected $validator;

  public function __construct(Validation $validator){
      $this->validator = $validator;
  }
  public function handle(CreateTransportCommand $command) {
      $this->validate($command);

      $transport = new Transport();
      $transport->uuid = (string) \Illuminate\Support\Str::uuid();
      $transport->name = $command->name;
      $transport->model = $command->model ? $command->model : null;
      $transport->type_uuid = $command->type_uuid;
      $transport->slug = str_replace(' ', '_', $transport->name);

      return $transport->save() ? $transport : [] ;
  } 

  protected function validate(CreateTransportCommand $command) {
    $rules = [
      'name' => ['required', 'string'],
      'type_uuid' => ['required', 'uuid'],
    ];

    $validator = $this->validator->make($command->toArray(), $rules);
    $validator->validate();
  }
}