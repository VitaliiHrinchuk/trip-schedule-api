<?php
namespace Services\Company\Commands;

class CreateCompanyCommand{
  public $name;

  public function __construct(?string $name){
    $this->name = $name;
  }

  public function toArray(){
    return get_object_vars($this);
  }
}