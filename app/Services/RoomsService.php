<?php

namespace App\Services;
use Illuminate\Http\Request;
use App\Room;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class RoomsService extends TransformerService{

  public function all(Request $request){

    $type = $request->type != "All" && $request->type != null ? $request->type : '';

    $title = $request->title ? $request->title : '';

    $location = $request->location ? $request->location : '';

    $rooms = Room::where("title", 'like', "%{$title}%");
    if($request->type != "All" && $request->type != null){
        $rooms = $rooms->where("type", $request->type);
    }

    if($request->location != null){
        $rooms = $rooms->where("location", $request->location);
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
    'location' => $room->location,
    'user_id' => $room->user_id,
    'name' => $room->user->name
  ];
}

  public function store(Request $request){

    $data = $request->validate([
      'title' => 'required',
      'description' => 'required',
      'price' => 'required',
      'type' => 'required',
      'location' => 'required',
    ]);
    $image = $request->file('room');
    $extension = $image->getClientOriginalExtension();
    Storage::disk('public')->put($image->getFilename().'.'.$extension,  File::get($image));


    $room = Room::create([
      'title' => $data["title"],
      'description' => $data["description"],
      'price' => $data["price"],
      'type' => $data["type"],
      'location' => $data["location"],
      'user_id' => auth()->user()->id,
      // 'mime' => $image->getClientMimeType(),
      // 'original_filename' => $image->getClientOriginalName(),
      // 'filename' => $image->getFilename().'.'.$extension,
     ]);

  return redirect()->route('rooms.index');
}

public function update(Request $request, Room $room){
  $data = $request->validate([
    'title' => 'required',
    'description' => 'required',
    'price' => 'required',
    'type' => 'required',
    'location' => 'required',
  ]);

  $room->title = $data['title'];
  $room->description = $data['description'];
  $room->price = $data['price'];
  $room->type = $data['type'];
  $room->location = $data['location'];
  $room->save();

  return redirect()->route('rooms.index');
}

public function destroy(Room $room){
  $room->delete();

  return response()->json('deleted');
}




}
