<?php
namespace Services\City\Handlers;

use Services\City\Commands\BulkCreateCitiesCommand;
use Illuminate\Contracts\Validation\Factory as Validation;
use App\Models\City;

class BulkCreateCitiesCommandHandler{

  protected $validator;

  public function __construct(Validation $validator){
      $this->validator = $validator;
  }
  public function handle(BulkCreateCitiesCommand $command) {
      $this->validate($command);

      $current_cities = City::all()->pluck('name')->toArray();

      $new_cities = array_diff($command->cities, $current_cities);

      $formatted = [];

      foreach ($new_cities as $city) {
        $formatted[] = [
          'uuid' => (string) \Illuminate\Support\Str::uuid(),
          'name' => $city
        ];
      };

      return City::insert($formatted) ? 'ok' : '';
  } 

  protected function validate(BulkCreateCitiesCommand $command) {
    $rules = [
      'cities' => ['required', 'array']
    ];

    $validator = $this->validator->make($command->toArray(), $rules);
    $validator->validate();
  }
}