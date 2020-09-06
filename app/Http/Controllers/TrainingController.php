<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\TrainingExercise;


class TrainingController extends Controller
{
  public function __construct()

  {
  $this->middleware('auth:api');

  //  $this->middleware('isAdmin');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $q = TrainingExercise::with(['enrolments'])->orderBy('created_at','desc')->get();
      return response()->json($q,200);
    }

    public function activetraining()
    {
      $q = TrainingExercise::where('status', 'active')->orderBy('created_at','desc')->get();
      return response()->json($q,200);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $q = $request->isMethod('put') ? TrainingExercise::findOrfail
      ($request->training_id) : new TrainingExercise;

      $q->user_id = Auth::user()->id;
      $q->id = $request->input('training_id');
      $q->exercise_name = $request->input('exercise_name');
      $q->exercise_link = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 300);
      $q->pic = $request->input('pic');
      $q->batch = $request->input('batch');
      $q->description = $request->input('description');
      $q->date = $request->input('date');
      $q->training_fee = $request->input('training_fee');
      $q->status = $request->input('status');
      if($q->save()){
        // return new QuestionResource($q);
        return response()->json($q,200);
      }
    }

    public function makeActive(TrainingExercise $train, Request $request)
        {
            $train->status = 'active';
            $status = $train->save();

            return response()->json([
                'status'    => $status,
                'data'      => $train,
                'message'   => $status ? 'Training Updated' : 'Error'
            ]);
        }

        public function makeClosed(TrainingExercise $train, Request $request)
            {
                $train->status = 'closed';
                $status = $train->save();

                return response()->json([
                    'status'    => $status,
                    'data'      => $train,
                    'message'   => $status ? 'Training Updated' : 'Error'
                ]);
            }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $training = TrainingExercise::where('exercise_link', $id)->get();
        return response()->json($training,200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
