<?php
namespace Services\Transport\Commands;

class ListQueryTransportCommand {

  public function __construct(){

  }

  public function toArray(){
    return get_object_vars($this);
  }
}