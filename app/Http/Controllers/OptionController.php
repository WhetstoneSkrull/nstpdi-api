<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\Option as OptionResource;
use App\User;
use Auth;
use App\Option;

class OptionController extends Controller
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
        //
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
      $q = $request->isMethod('put') ? Option::findOrfail
      ($request->option_id) : new Option;

      // $q->user_id = Auth::user()->id;
      $q->id = $request->input('option_id');
      $q->question_id = $request->input('question_id');
      $q->option_body = $request->input('option_body');
      $q->is_correct = $request->input('is_correct');


      if($q->save()){
        // return new OptionResource($q);
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
      $q = Option::findOrfail($id);
      return new  OptionResource($q);
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
