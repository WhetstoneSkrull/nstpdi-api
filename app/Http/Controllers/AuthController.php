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
        'contact' => 'required|string',
    ]);

    $user = new User([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'pic'=> ('placeholder.jpg'),
        'contact' => $request->contact,
        'other_names' => $request->other_names,
        'dob' => $request->dob,
        'place_of_birth' => $request->place_of_birth,
        'state_of_origin' => $request->state_of_origin,
        'home_address' => $request->home_address,
        'gender' => $request->gender,
        'marital_status' => $request->marital_status,
        'bank_name' => $request->bank_name,
        'bank_account_number' => $request->bank_account_number,
        'bank_location' => $request->bank_location,
        'bank_sort_code' => $request->bank_sort_code,
        'tax_identification_number' => $request->tax_identification_number,
        'pension_fund_admin' => $request->pension_fund_admin,
        'retirement_account_pin' => $request->retirement_account_pin,
        'nhf_account' => $request->nhf_account,
        'activation_token' => str_random(60),
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
