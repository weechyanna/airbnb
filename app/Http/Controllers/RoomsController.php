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

  public function create(){
    return view('rooms.create');
  }

  public function store(Request $request){
    return $this->roomsService->store($request);
  }

  public function edit(Room $room){
    return view('rooms.edit', ['room' => $room]);
  }

  public function update(Request $request, Room $room){
    return $this->roomsService->update($request,$room);
  }

  public function destroy(Room $room){
    return $this->roomsService->destroy($room);
  }



}
