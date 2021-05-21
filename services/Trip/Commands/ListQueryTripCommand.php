<?php
namespace Services\Trip\Commands;

class ListQueryTripCommand {

  public $query;

  public function __construct(?array $query){
    $this->query = $query;
  }

  public function toArray(){
    return get_object_vars($this);
  }
}