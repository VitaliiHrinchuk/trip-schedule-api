<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use League\Tactician\CommandBus;
use Services\User\Commands\CreateUserCommand;

class AuthController extends Controller
{

    protected $bus;
    public function __construct(CommandBus $bus)
    {
        $this->bus = $bus;
    }
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function register(Request $request){
        // $this->validate($request, [
        //     'name' => 'required|string',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required',
        // ]);

        // $current_user = Auth::user();
        // $current_role = DB::table('roles')->where('uuid', $current_user->role_uuid)->first();

        
        // if($current_role->slug != 'super_admin'){
        //    return response()->json(['message' => 'You have no rights to register users', 'Error' => $e], 403);
        // }

        // try {
           

        //     $role = DB::table('roles')->where('slug', 'admin')->first();
        //     $user = new User();
        //     $user->uuid = (string) Uuid::uuid4();
        //     $user->name = $request->input('name');
        //     $user->email = $request->input('email');
        //     $user->role_uuid = $role->uuid;
        //     $plainPassword = $request->input('password');
        //     $user->password = app('hash')->make($plainPassword);

        //     $user->save();

         
        //   return response()->json(['user' => $user, 'message' => 'CREATED'], 201);

        // } catch (\Exception $e) {
         
        //     return response()->json(['message' => 'User Registration Failed! ', 'Error' => $e], 409);
        // }
        $command = new CreateUserCommand('a', 'b');
        $result = $this->bus->handle($command);
        return response()->json([], 200);
    }


    /**
     * Get a JWT via given credentials.
     *
     * @param  Request  $request
     * @return Response
     */
    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Wrong email and password combination'], 401);
        }

        return $this->respondWithToken($token);
    }

    
    /**
     * Get user data
     *
     * @param  Request  $request
     * @return Response
     */
    public function iam(Request $request){
        return response()->json(Auth::user,200);
    }


    
}