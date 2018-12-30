<?php

namespace App\Services;
use App\Room;
use Illuminate\Http\Request;


class RoomsService extends TransformerService{

  public function all(Request $request){

    $type = $request->type != "All" && $request->type != null ? $request->type : '';

    $title = $request->title ? $request->title : '';

    $rooms = Room::where("title", 'like', "%{$title}%");
    if($request->type != "All" && $request->type != null){
        $rooms = $rooms->where("type", $request->type);
    }

      // if($request->has("type") && $request->type != "All"){
      //   $rooms = Room::where("type", $request->type)->get();
      // }else{
      //   $rooms = Room::all();
      // }
        return response()->json($this->transformCollection($rooms->get()));
  }

  public function transform($room){
  return [
    'id' => $room->id,
    'title' => $room->title,
    'description' => $room->description,
    'price' => $room->price,
    'type' => $room->type,
    'location' => $room->location
  ];
}


}
