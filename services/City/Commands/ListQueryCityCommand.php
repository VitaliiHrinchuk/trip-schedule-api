<?php
namespace Services\City\Commands;

class ListQueryCityCommand{

  public function __construct(){

  }

  public function toArray(){
    return get_object_vars($this);
  }
}