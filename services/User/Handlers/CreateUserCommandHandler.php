<?php
namespace Services\User\Handlers;

use Services\User\Commands\CreateUserCommand;

class CreateUserCommandHandler{
  public function __construct()
  {
   
  }
  public function handle(CreateUserCommand $command) {
    // ...
    print_r($command);
  } 
}