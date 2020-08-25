<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Message;

class MessageController extends Controller
{
  public function index()
  {
    $all = Message::orderBy('created_at','desc');
        return response()->json($all->get(),200);
  }

  public function show($id)
  {
    //
  }
  public function create()
  {
    //
  }

  public function store(Request $request)
  {
    $request->validate([
      'full_name'=>'required',
      'email'=> 'required|string',
      'message_body' => 'required'
    ]);
    $share = new Message([
      'full_name' => $request->get('full_name'),
      'email'=> $request->get('email'),
      'message_body'=> $request->get('message_body'),
      'contact'=> $request->get('contact'),
      'state'=> $request->get('state')
    ]);
    $share->save();
    return redirect('/')->with('success', 'Message has been added');
  }

}
