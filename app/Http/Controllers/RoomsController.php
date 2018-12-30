<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\RoomsService;

class RoomsController extends Controller{

  private $roomService;

  public function __construct(RoomsService $roomService){
   $this->roomsService = $roomService;
 }



  public function index(Request $request){
    if ($request->wantsJson()){
      // return a JSON response
      return $this->roomsService->all($request);
     }
     // otherwise we will return the view
     return view('rooms.index');
  }


}
