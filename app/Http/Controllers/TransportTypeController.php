<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use League\Tactician\CommandBus;
use Services\TransportType\Commands\CreateTransportTypeCommand;
use Services\TransportType\Commands\ShowTransportTypeCommand;
use Services\TransportType\Commands\DeleteTransportTypeCommand;
use Services\TransportType\Commands\UpdateTransportTypeCommand;
use Services\TransportType\Commands\ListQueryTransportTypeCommand;
use Illuminate\Http\JsonResponse;

class TransportTypeController extends Controller
{

    protected $bus;

    public function __construct(CommandBus $bus) {
        $this->bus = $bus;
    }

    public function store(Request $request){
      
      $command = new CreateTransportTypeCommand($request->get('slug'));
      $result = $this->bus->handle($command);
      if ($result) {
        return new JsonResponse($result, 201);
      }
      return new JsonResponse(['error' => 'Invalid request'], 400);
    }

    public function index(Request $request){
      
      $command = new ListQueryTransportTypeCommand();
      $result = $this->bus->handle($command);
      if ($result) {
        return new JsonResponse($result, 200);
      }
      return new JsonResponse(['error' => 'Invalid request'], 400);
    }

    public function show($uuid){
      
      $command = new ShowTransportTypeCommand($uuid);
      $result = $this->bus->handle($command);
      if ($result) {
        return new JsonResponse($result, 200);
      }
    }

    
    public function update(Request $request){

      $command = new UpdateTransportTypeCommand($request->uuid,$request->get('slug'));
      $result = $this->bus->handle($command);
      if ($result) {
        return new JsonResponse($result, 200);
      }
    }

    public function destroy($uuid){
      
      $command = new DeleteTransportTypeCommand($uuid);
      $result = $this->bus->handle($command);
      if ($result) {
        return new JsonResponse(null, 204);
      }
    }


}