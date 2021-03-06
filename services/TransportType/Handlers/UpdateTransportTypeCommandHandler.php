<?php
namespace Services\TransportType\Handlers;

use Services\TransportType\Commands\UpdateTransportTypeCommand;
use Illuminate\Contracts\Validation\Factory as Validation;
use App\Models\TransportType;

class UpdateTransportTypeCommandHandler{

  protected $validator;

  public function __construct(Validation $validator){
      $this->validator = $validator;
  }
  public function handle(UpdateTransportTypeCommand $command) {
      $this->validate($command);

      $type = TransportType::where('uuid', $command->uuid)->firstOrFail();
      $type->slug = $command->slug;

      
      return $type->save() ? $type : [] ;
  } 

  protected function validate(UpdateTransportTypeCommand $command) {
    $rules = [
      'slug' => ['required', 'string'],
      'uuid' => ['required']
    ];  

    $validator = $this->validator->make($command->toArray(), $rules);
    $validator->validate();
  }
}