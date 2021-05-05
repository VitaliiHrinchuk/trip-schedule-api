<?php
namespace Services\Trip\Commands;

class UpdateTripCommand {
  public $uuid;
  public $departure_date;
  public $return_date;
  public $seats;
  public $company_uuid;
  public $departure_city_uuid;
  public $arrival_city_uuid;
  public $transport_uuid;

  public function __construct(
    ?string $uuid,
    ?string $departure_date, 
    ?string $return_date, 
    ?int $seats,
    ?string $company_uuid,
    ?string $departure_city_uuid,
    ?string $arrival_city_uuid,
    ?string $transport_uuid
  ){
    $this->uuid = $uuid;
    $this->departure_date = $departure_date;
    $this->return_date = $return_date;
    $this->seats = $seats;
    $this->company_uuid = $company_uuid;
    $this->departure_city_uuid = $departure_city_uuid;
    $this->arrival_city_uuid = $arrival_city_uuid;
    $this->transport_uuid = $transport_uuid;
  }

  public function toArray(){
    return get_object_vars($this);
  }
}