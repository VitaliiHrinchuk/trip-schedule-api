<?php
namespace Services\User\Commands;

class LoginUserCommand{
  public $email;
  public $password;

  public function __construct(?string $email, ?string $password){
    $this->email = $email;
    $this->password = $password;
  }

  public function toArray(){
    return get_object_vars($this);
  }
}