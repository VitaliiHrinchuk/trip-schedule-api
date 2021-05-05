<?php
namespace Services\City\Handlers;

use Services\City\Commands\ListQueryCityCommand;
use Illuminate\Contracts\Validation\Factory as Validation;
use App\Models\City;

class ListQueryCityCommandHandler{

  public function __construct(){

  }
  public function handle(ListQueryCityCommand $command) {
      return City::paginate();
  } 

  
}