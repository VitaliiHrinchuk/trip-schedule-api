<?php
namespace Services\City\Commands;

class BulkCreateCitiesCommand{
  public $cities;

  public function __construct(?array $cities){
    $this->cities = $cities;
  }

  public function toArray(){
    return get_object_vars($this);
  }
}