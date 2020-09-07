<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\Question as QuestionResource;
use App\User;
use Auth;
use App\Question;

class QuestionController extends Controller
{
  public function __construct()

  {
  // $this->middleware('auth:api');

  //  $this->middleware('isAdmin');
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $q = Question::inRandomOrder()->paginate(250);
       return QuestionResource::collection($q);

      // return response()->json($q,200);
    }

    public function getquestionsadder()
    {
      $q = Question::orderBy('created_at','desc')->paginate(10);
       return QuestionResource::collection($q);

      // return response()->json($q,200);
    }

    public function countquestions()
    {
      $q = Question::orderBy('created_at','desc')->count();
      return response()->json($q,200);
    }

    public function getpracticequestions(){
        $q = Question::inRandomOrder()->where('question_type','multiple_choice')->with(['options'])->limit(10)->get();
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
      $q = $request->isMethod('put') ? Question::findOrfail
      ($request->question_id) : new Question;

      $q->user_id = 1;
      $q->id = $request->input('question_id');
      $q->thematic_areas_id = $request->input('thematic_areas_id');
      $q->question_type = $request->input('question_type');
      $q->is_graded = $request->input('is_graded');
      $q->body = $request->input('body');
      $q->answer = $request->input('answer');

      if($q->save()){
        // return new QuestionResource($q);
        return response()->json($q,200);

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
      // $q = Question::findOrfail($id);
      // return new  QuestionResource($q);

      $module = Question::where('id', $id)->with([ 'options'])->get();
      // return new  ModuleResource($module);
      return response()->json($module,200);
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
      $q = Question::findOrfail($id);
      if($q->delete()){
        // return new  VehicleResource($vehicle);
        return response()->json($q,200);

  }
    }
}
