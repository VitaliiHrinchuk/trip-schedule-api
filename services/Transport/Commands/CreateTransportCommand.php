<?php
namespace Services\Transport\Commands;

class CreateTransportCommand{
  public $name;
  public $model;
  public $type_uuid;

  public function __construct(?string $name, ?string $model, ?string $type_uuid){
    $this->name = $name;
    $this->model = $model;
    $this->type_uuid = $type_uuid;
  }

  public function toArray(){
    return get_object_vars($this);
  }
}