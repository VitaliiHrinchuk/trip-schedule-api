<?php
namespace Services\Company\Handlers;

use Services\Company\Commands\UpdateCompanyCommand;
use Illuminate\Contracts\Validation\Factory as Validation;
use App\Models\Company;

class UpdateCompanyCommandHandler{

  protected $validator;

  public function __construct(Validation $validator){
      $this->validator = $validator;
  }
  public function handle(UpdateCompanyCommand $command) {
      $this->validate($command);

      $company = Company::where('uuid', $command->uuid)->firstOrFail();
      $company->name = $command->name;

      
      return $company->save() ? $company : [] ;
  } 

  protected function validate(UpdateCompanyCommand $command) {
    $rules = [
      'name' => ['required', 'string'],
      'uuid' => ['required']
    ];  

    $validator = $this->validator->make($command->toArray(), $rules);
    $validator->validate();
  }
}