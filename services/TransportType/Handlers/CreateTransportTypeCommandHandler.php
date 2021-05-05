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

      $company = new TransportType();
      $company->uuid = (string) \Illuminate\Support\Str::uuid();
      $company->slug = $command->slug;

      return $company->save() ? $company : [] ;
  } 

  protected function validate(CreateTransportTypeCommand $command) {
    $rules = [
      'slug' => ['required', 'string']
    ];

    $validator = $this->validator->make($command->toArray(), $rules);
    $validator->validate();
  }
}