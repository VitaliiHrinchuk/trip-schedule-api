<?php
namespace Services\User\Handlers;

use Services\User\Commands\LoginUserCommand;
use Illuminate\Contracts\Validation\Factory as Validation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class LoginUserCommandHandler{

  protected $validator;

  public function __construct(Validation $validator) {
    $this->validator = $validator;
  }

  public function handle(LoginUserCommand $command) {
      $this->validate($command);
    
      if (! $token = Auth::attempt($command->toArray())) {
          throw ValidationException::withMessages(['login' => 'Невірна комбінація логіна і паролю']);
      }

      return ["access_token" => $token];
  } 

  protected function validate(LoginUserCommand $command) {
      $rules = [
        'email' => ['required', 'string', 'email'],
        'password' => ['required', 'string']
      ];

      $validator = $this->validator->make($command->toArray(), $rules);
      $validator->validate();
  }
}