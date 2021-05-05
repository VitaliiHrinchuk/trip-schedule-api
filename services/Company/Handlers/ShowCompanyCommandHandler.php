<?php
namespace Services\Company\Handlers;

use Services\Company\Commands\ShowCompanyCommand;
use Illuminate\Contracts\Validation\Factory as Validation;
use App\Models\Company;

class ShowCompanyCommandHandler{

  protected $validator;

  public function __construct(Validation $validator){
      $this->validator = $validator;
  }
  public function handle(ShowCompanyCommand $command) {

      $this->validate($command);

      return Company::where('uuid', $command->uuid)->firstOrFail();
  } 

  protected function validate(ShowCompanyCommand $command) {
    $rules = [
      'uuid' => ['required']
    ];

    $validator = $this->validator->make($command->toArray(), $rules);
    $validator->validate();
  }
}