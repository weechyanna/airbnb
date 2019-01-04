<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
      if ($request->wantsJson()){
        // return a JSON response
        return $this->roomsService->all($request);
       }
       // otherwise we will return the view
       return view('admin.index');
    }
}
