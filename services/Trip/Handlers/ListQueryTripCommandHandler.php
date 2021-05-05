<?php
namespace Services\Trip\Handlers;

use Services\Trip\Commands\ListQueryTripCommand;
use Illuminate\Contracts\Validation\Factory as Validation;
use App\Models\Trip;

class ListQueryTripCommandHandler{

  public function __construct(){

  }
  public function handle(ListQueryTripCommand $command) {
      return Trip::with('departureCity', 'arrivalCity', 'transport', 'company')
                  ->paginate();
  } 

  
}