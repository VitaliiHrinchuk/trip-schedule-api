<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use League\Tactician\CommandBus;
use Services\City\Commands\BulkCreateCitiesCommand;
use Services\City\Commands\ListQueryCityCommand;
use Illuminate\Http\JsonResponse;

class CityController extends Controller
{

    protected $bus;

    public function __construct(CommandBus $bus) {
        $this->bus = $bus;
    }

    public function index(Request $request){
      
      $command = new ListQueryCityCommand();
      $result = $this->bus->handle($command);
      if ($result) {
        return new JsonResponse($result, 200);
      }
      return new JsonResponse(['error' => 'Invalid request'], 400);
    }

    public function store(Request $request){
      
      $command = new BulkCreateCitiesCommand($request->get('cities'));
      $result = $this->bus->handle($command);
      if ($result) {
        return new JsonResponse($result, 201);
      }
      return new JsonResponse(['error' => 'Invalid request'], 400);
    }
}