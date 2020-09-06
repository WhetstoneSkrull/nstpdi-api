<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;

class AuthController extends Controller
{

  public function __construct()

  {
  $this->middleware('auth:api',['except'=>['signup', 'login']]);

  //  $this->middleware('isAdmin');
}

  public function signup(Request $request)
{
    $request->validate([
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'email' => 'required|string|email|unique:users',
        'password' => 'required|string|confirmed',
        'primary_contact' => 'required|string',
    ]);

    $user = new User([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'pic'=> ('placeholder.jpg'),
        'primary_contact' => $request->primary_contact,
        'secondary_contact' => $request->secondary_contact,
        // 'dob' => $request->dob,
        'location' => $request->location,
        'is_admin' => $request->is_admin,
        'place_of_work' => $request->place_of_work,
        'position_held' => $request->position_held,
        'user_type' => $request->user_type,
        // 'activation_token' => str_random(60),
        'password' => bcrypt($request->password)
    ]);
    $user->save();


    // $user->enrolment()->createMany( array( 3, 5, 7 ) );
    // $user->enrolment()->attach('module_id');

    return response()->json([
        'message' => 'Successfully created user!'
    ], 201);
  }

  public function login(Request $request)
       {
           $request->validate([
               'email' => 'required|string|email',
               'password' => 'required|string',
               'remember_me' => 'boolean'
           ]);

           $credentials = request(['email', 'password']);

           if(!Auth::attempt($credentials))
               return response()->json([
                   'message' => 'Unauthorized'
               ], 401);

           $user = $request->user();

           $tokenResult = $user->createToken('Personal Access Token');
           $token = $tokenResult->token;
           if ($request->remember_me)
               $token->expires_at = Carbon::now()->addWeeks(1);
               $token->save();

        //     $user = User::where('email', Auth::user()->email)->first();
        // $user->notify(new TestEmail($user));


           return response()->json([
               'access_token' => $tokenResult->accessToken,
               'token_type' => 'Bearer',
               'user' => Auth::user(),
               'expires_at' => Carbon::parse(
                   $tokenResult->token->expires_at
               )->toDateTimeString()
           ]);
       }

       public function user(Request $request)
      {
          return response()->json($request->user());
      }


}
