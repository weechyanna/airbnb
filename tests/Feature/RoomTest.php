<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Room;

/**
 * A basic test example.
 *
 * @group room_test
 */

class RoomTest extends TestCase{

  use RefreshDatabase;

  /**
   * @test
   *
   */
   public function it_should_get_the_listings(){
     $rooms = factory('App\Room', 3)->create();

     $response = $this->json('GET', '/rooms');

     $response->assertStatus(200)
              ->assertJsonCount(3);
   }

   /**
    * @test
    *
    */
   public function it_should_create_listing(){
     $room = factory('App\Room')->make();
     $user = factory('App\User')->create();

     $response = $this->actingAs($user)
                 ->post('rooms', [
       'title' => $room->title,
       'description' => $room->description,
       'price' => $room->price,
       'type' => $room->type,
       'location' => $room->location
     ]);
     $response->assertStatus(302);
     echo(Room::count());
     //echo Room::where('title', $room->title)->where('user_id',$room->user_id)->first()->title;
     //$this->assertTrue(Room::where('title', $room->title)->where('user_id',$room->user_id)->first()!=null);
   }

   /**
    * @test
    *
    */
   public function it_should_edit_listing(){
     $room = factory('App\Room')->make();
     $user = factory('App\User')->create();

     $room->user_id = $user->id;
     $room->save();

     $update = $this->actingAs($user)->json('PUT', '/rooms/' . $room->id,['title' => "Changed for test"]);
     $update->assertStatus(302);
   }

   /**
    * @test
    *
    */
    public function it_should_delete_listing(){
      $room = factory('App\Room')->make();
      $user = factory('App\User')->create();

      $room->user_id = $user->id;
      $room->save();

      $update = $this->actingAs($user)->json('DELETE', '/rooms/' . $room->id);
      $update->assertStatus(200);
    }

}
