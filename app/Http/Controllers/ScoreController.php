<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\Score as ScoreResource;
use App\User;
use Auth;
use App\Score;

class ScoreController extends Controller
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
      $scores = Score::orderBy('created_at','desc')->paginate(100);
      return ScoreResource::collection($scores);
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
      $score = $request->isMethod('put') ? Score::findOrfail
      ($request->score_id) : new Score;

      $score->user_id = Auth::user()->id;
      $score->id = $request->input('score_id');
      $score->total_score = $request->input('total_score');
      $score->score_percentage = $request->input('score_percentage');


      if($score->save()){
        // return new ScoreResource($score);
        return response()->json($score,200);

      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $score = Score::findOrfail($id);
      return new  ScoreResource($score);
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
