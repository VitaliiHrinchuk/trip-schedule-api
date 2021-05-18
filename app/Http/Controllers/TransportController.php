<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use League\Tactician\CommandBus;
use Services\Transport\Commands\CreateTransportCommand;
use Services\Transport\Commands\ShowTransportCommand;
use Services\Transport\Commands\DeleteTransportCommand;
use Services\Transport\Commands\UpdateTransportCommand;
use Services\Transport\Commands\ListQueryTransportCommand;
use Illuminate\Http\JsonResponse;

class TransportController extends Controller
{

    protected $bus;

    public function __construct(CommandBus $bus) {
        $this->bus = $bus;
    }

    public function index(Request $request){
      
      $command = new ListQueryTransportCommand();
      $result = $this->bus->handle($command);
      if ($result) {
        return new JsonResponse($result, 200);
      }
      return new JsonResponse(['error' => 'Invalid request'], 400);
    }

    public function store(Request $request){
      
      $command = new CreateTransportCommand($request->get('name'), $request->get('model'), $request->get('type_uuid'));
      $result = $this->bus->handle($command);
      if ($result) {
        return new JsonResponse($result, 201);
      }
      return new JsonResponse(['error' => 'Invalid request'], 400);
    }

    public function show($uuid){
      
      $command = new ShowTransportCommand($uuid);
      $result = $this->bus->handle($command);
      if ($result) {
        return new JsonResponse($result, 200);
      }
    }

    
    public function update(Request $request){
      
      $command = new UpdateTransportCommand($request->uuid,$request->get('name'), $request->get('model'), $request->get('type_uuid'));
      $result = $this->bus->handle($command);
      if ($result) {
        return new JsonResponse($result, 200);
      }
    }

    public function destroy($uuid){
      
      $command = new DeleteTransportCommand($uuid);
      $result = $this->bus->handle($command);
      if ($result) {
        return new JsonResponse(null, 204);
      }
    }


}