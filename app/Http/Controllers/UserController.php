<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Enrolment;
use App\Module;
use App\Http\Resources\User as UserResource;
use Auth;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
  public function __construct()

  {
  $this->middleware('auth:api');
  //  $this->middleware('isAdmin');
  }

  public function index()
  {
    $users = User::orderBy('created_at','desc')->with(['scores','times','locations'])->paginate(100);
    // return UserResource::collection($users);
    return response()->json($users,200);
  }

 public function show($id)
 {
   // $user = User::findOrfail($id);
   // return new  UserResource($user);

   $user = User::where('id', $id)->with(['scores.module', 'times','locations.module', 'enrolment.module'])->get();
   return response()->json($user,200);
 }


  public function teachers()
  {

    $user = User::where('user_type', 'teacher')->get();
    return response()->json($user,200);
  }



  public function uploadUserPic(Request $request){
                $user_image = $request->user_image;
            if(!$user_image){
                return response()->json([
                    'status' => 422,
                    'message' => 'Image file was not found, please check the file and try again'
                ]);
            }else{
                if($request->file('user_image')) {
                    $image = $request->file('user_image');
                    $name = time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/image');
                    $image->move($destinationPath, $name);
                }
                $id = Auth::user()->id;
                $findUser = User::find($id);
                $findUser->pic = $name;

                $updateImage = $findUser->update();
                if($updateImage){
                    return response()->json([
                        'status' => 200,
                        'message' => 'Profile image has been successfully uploaded'
                    ]);
                }else{
                    return response()->json([
                        'status' => 422,
                        'message' => 'Failed to upload user profile image'
                    ]);
                }
            }

       }

       public function snapPic(Request $request){

               $image = $request->user_image;
               $image = str_replace('data:image/png;base64,', '', $image);
               $image = str_replace(' ', '+', $image);
               $data = base64_decode($image);
               $file = 'image/img'.date("YmdHis").'.png';
               $str = substr($file, 6);
                 if (file_put_contents($file, $data)) {

                   $id = $request->user_id;
                   $findUser = User::find($id);
                   $findUser->pic = $str;

                   $updateImage = $findUser->update();
                    return response()->json([
                        'message' => 'The canvas was saved as $str.'
                    ], 200);
                 } else {
                   return response()->json([
                       'message' => 'The canvas could not be saved.'
                   ],422);
                 }
             }

  public function updateLocation(User $user, Request $request)
  {
      $user->location = $request->input('location');
      $status = $user->save();

      return response()->json([
          'status'    => $status,
          'data'      => $user,
          'message'   => $status ? 'Location Updated' : 'Error'
      ]);
  }

}
