<?php
namespace Services\Company\Handlers;

use Services\Company\Commands\DeleteCompanyCommand;
use Illuminate\Contracts\Validation\Factory as Validation;
use App\Models\Company;

class DeleteCompanyCommandHandler{

  protected $validator;

  public function __construct(Validation $validator){
      $this->validator = $validator;
  }
  public function handle(DeleteCompanyCommand $command) {
      $this->validate($command);
      $company = Company::where('uuid', $command->uuid)->firstOrFail();

      return $company->delete();
  } 

  protected function validate(DeleteCompanyCommand $command) {
    $rules = [
      'uuid' => ['required']
    ];

    $validator = $this->validator->make($command->toArray(), $rules);
    $validator->validate();
  }
}