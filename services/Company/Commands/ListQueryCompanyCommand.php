<?php
namespace Services\Company\Commands;

class ListQueryCompanyCommand {

  public function __construct(){

  }

  public function toArray(){
    return get_object_vars($this);
  }
}