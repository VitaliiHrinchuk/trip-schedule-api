<?php
namespace Services\Company\Handlers;

use Services\Company\Commands\CreateCompanyCommand;
use Illuminate\Contracts\Validation\Factory as Validation;
use App\Models\Company;

class CreateCompanyCommandHandler{

  protected $validator;

  public function __construct(Validation $validator){
      $this->validator = $validator;
  }
  public function handle(CreateCompanyCommand $command) {
      $this->validate($command);

      $company = new Company();
      $company->uuid = (string) \Illuminate\Support\Str::uuid();
      $company->name = $command->name;

      return $company->save() ? $company : [] ;
  } 

  protected function validate(CreateCompanyCommand $command) {
    $rules = [
      'name' => ['required', 'string']
    ];

    $validator = $this->validator->make($command->toArray(), $rules);
    $validator->validate();
  }
}