<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
  public function index()
  {
      return view("landing");
  }

  public function agent()
  {
      return view("applyagent");
  }
}
