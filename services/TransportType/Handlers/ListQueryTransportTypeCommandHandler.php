<?php
namespace Services\TransportType\Handlers;

use Services\TransportType\Commands\ListQueryTransportTypeCommand;
use Illuminate\Contracts\Validation\Factory as Validation;
use App\Models\TransportType;

class ListQueryTransportTypeCommandHandler{

  public function __construct(){

  }
  public function handle(ListQueryTransportTypeCommand $command) {
      return TransportType::paginate();
  } 

  
}