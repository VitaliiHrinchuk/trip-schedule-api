<?php
namespace Services\Company\Handlers;

use Services\Company\Commands\ListQueryCompanyCommand;
use Illuminate\Contracts\Validation\Factory as Validation;
use App\Models\Company;

class ListQueryCompanyCommandHandler{

  public function __construct(){

  }
  public function handle(ListQueryCompanyCommand $command) {
      return Company::paginate();
  } 

  
}