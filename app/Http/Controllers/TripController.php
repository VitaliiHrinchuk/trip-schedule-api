<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use League\Tactician\CommandBus;
use Services\Trip\Commands\CreateTripCommand;
use Services\Trip\Commands\ShowTripCommand;
use Services\Trip\Commands\DeleteTripCommand;
use Services\Trip\Commands\UpdateTripCommand;
use Services\Trip\Commands\ListQueryTripCommand;
use Illuminate\Http\JsonResponse;

class TripController extends Controller
{

    protected $bus;

    public function __construct(CommandBus $bus) {
        $this->bus = $bus;
    }

    public function index(Request $request){
      
      $command = new ListQueryTripCommand();
      $result = $this->bus->handle($command);
      if ($result) {
        return new JsonResponse($result, 200);
      }
      return new JsonResponse(['error' => 'Invalid request'], 400);
    }

    public function store(Request $request){
      
      $command = new CreateTripCommand($request->get('departure_date'), 
                                       $request->get('return_date'), 
                                       $request->get('seats'),
                                       $request->get('company_uuid'),
                                       $request->get('departure_city_uuid'),
                                       $request->get('arrival_city_uuid'),
                                       $request->get('transport_uuid'));
      $result = $this->bus->handle($command);
      if ($result) {
        return new JsonResponse($result, 201);
      }
      return new JsonResponse(['error' => 'Invalid request'], 400);
    }

    public function show($uuid){
      
      $command = new ShowTripCommand($uuid);
      $result = $this->bus->handle($command);
      if ($result) {
        return new JsonResponse($result, 200);
      }
    }

    
    public function update(Request $request){
      
      $command = new UpdateTripCommand( $request->uuid,
                                        $request->get('departure_date'), 
                                        $request->get('return_date'), 
                                        $request->get('seats'),
                                        $request->get('company_uuid'),
                                        $request->get('departure_city_uuid'),
                                        $request->get('arrival_city_uuid'),
                                        $request->get('transport_uuid'));

      $result = $this->bus->handle($command);
      if ($result) {
        return new JsonResponse($result, 200);
      }
    }

    public function destroy($uuid){
      
      $command = new DeleteTripCommand($uuid);
      $result = $this->bus->handle($command);
      if ($result) {
        return new JsonResponse(null, 204);
      }
    }


}