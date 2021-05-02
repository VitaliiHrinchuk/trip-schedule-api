<?php
namespace Services\User\Commands;

class CreateUserCommand{
  public $email;
  public $password;

  public function __construct(string $email = 'a', String $password){
    $this->email = $email;
    $this->password = $password;
  }
}