<?php
namespace Services\Transport\Commands;

class DeleteTransportCommand{
  public $uuid;

  public function __construct(?string $uuid){
    $this->uuid = $uuid;
  }

  public function toArray(){
    return get_object_vars($this);
  }
}