<?php
namespace Services\Transport\Handlers;

use Services\Transport\Commands\ListQueryTransportCommand;
use Illuminate\Contracts\Validation\Factory as Validation;
use App\Models\Transport;

class ListQueryTransportCommandHandler{

  public function __construct(){

  }
  public function handle(ListQueryTransportCommand $command) {
      return Transport::with('type')->paginate();
  } 

  
}