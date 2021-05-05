<?php
namespace Services\Company\Commands;

class UpdateCompanyCommand{
  public $uuid;
  public $name;

  public function __construct(?string $uuid, ?string $name){
    $this->uuid = $uuid;
    $this->name = $name;
  }

  public function toArray(){
    return get_object_vars($this);
  }
}