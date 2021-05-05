<?php
namespace Services\TransportType\Commands;

class UpdateTransportTypeCommand{
  public $uuid;
  public $slug;

  public function __construct(?string $uuid, ?string $slug){
    $this->uuid = $uuid;
    $this->slug = $slug;
  }

  public function toArray(){
    return get_object_vars($this);
  }
}