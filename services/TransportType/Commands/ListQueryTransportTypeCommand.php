<?php
namespace Services\TransportType\Commands;

class ListQueryTransportTypeCommand {

  public function __construct(){

  }

  public function toArray(){
    return get_object_vars($this);
  }
}