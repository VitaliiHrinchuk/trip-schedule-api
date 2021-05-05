<?php
namespace Services\TransportType\Commands;

class CreateTransportTypeCommand{
  public $slug;

  public function __construct(?string $slug){
    $this->slug = $slug;
  }

  public function toArray(){
    return get_object_vars($this);
  }
}