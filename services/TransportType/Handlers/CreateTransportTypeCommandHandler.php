<?php
namespace Services\TransportType\Handlers;

use Services\TransportType\Commands\CreateTransportTypeCommand;
use Illuminate\Contracts\Validation\Factory as Validation;
use App\Models\TransportType;

class CreateTransportTypeCommandHandler{

  protected $validator;

  public function __construct(Validation $validator){
      $this->validator = $validator;
  }
  public function handle(CreateTransportTypeCommand $command) {
      $this->validate($command);

      $type = new TransportType();
      $type->uuid = (string) \Illuminate\Support\Str::uuid();
      $type->slug = $type->slug;

      return $type->save() ? $type : [] ;
  } 

  protected function validate(CreateTransportTypeCommand $command) {
    $rules = [
      'slug' => ['required', 'string']
    ];

    $validator = $this->validator->make($command->toArray(), $rules);
    $validator->validate();
  }
}