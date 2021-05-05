<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use League\Tactician\CommandBus;
use Services\Company\Commands\CreateCompanyCommand;
use Services\Company\Commands\ShowCompanyCommand;
use Services\Company\Commands\DeleteCompanyCommand;
use Services\Company\Commands\UpdateCompanyCommand;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller
{

    protected $bus;

    public function __construct(CommandBus $bus) {
        $this->bus = $bus;
    }

    public function store(Request $request){
      
      $command = new CreateCompanyCommand($request->get('name'));
      $result = $this->bus->handle($command);
      if ($result) {
        return new JsonResponse($result, 201);
      }
      return new JsonResponse(['error' => 'Invalid request'], 400);
    }

    public function show($uuid){
      
      $command = new ShowCompanyCommand($uuid);
      $result = $this->bus->handle($command);
      if ($result) {
        return new JsonResponse($result, 200);
      }
    }

    
    public function update(Request $request){
      
      $command = new UpdateCompanyCommand($request->uuid,$request->get('name'));
      $result = $this->bus->handle($command);
      if ($result) {
        return new JsonResponse($result, 200);
      }
    }

    public function destroy($uuid){
      
      $command = new DeleteCompanyCommand($uuid);
      $result = $this->bus->handle($command);
      if ($result) {
        return new JsonResponse(null, 204);
      }
    }


}