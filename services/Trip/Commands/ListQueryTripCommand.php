<?php
namespace Services\Trip\Commands;

class ListQueryTripCommand {

  public function __construct(){

  }

  public function toArray(){
    return get_object_vars($this);
  }
}