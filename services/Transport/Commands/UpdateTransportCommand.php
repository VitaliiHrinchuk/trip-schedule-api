<?php
namespace Services\Transport\Commands;

class UpdateTransportCommand{
  public $uuid;
  public $name;
  public $model;
  public $type_uuid;


  public function __construct(?string $uuid, ?string $name, ?string $model, ?string $type_uuid){
    $this->uuid = $uuid;
    $this->name = $name;
    $this->model = $model;
    $this->type_uuid = $type_uuid;
  }

  public function toArray(){
    return get_object_vars($this);
  }
}