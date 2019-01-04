@extends('layouts.master')

@section('master')

  {!! Form::open(['route' => 'rooms.store', 'files' => true]) !!}
    <div class="form-group">
      <label for="title">Title</label>
      <input type="title" name="title" class="form-control" id="title"  placeholder="Title">
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <input type="description" name="description" class="form-control" id="description"  placeholder="Description">
    </div>
    <div class="form-group">
      <label for="price">Price</label>
      <input type="price" name="price" class="form-control" id="price"  placeholder="Price">
    </div>
    <div class="form-group">
      <label for="type">Type</label>
      <input type="type" name="type" class="form-control" id="type"  placeholder="Type">
    </div>
    <div class="form-group">
      <label for="location">Location</label>
      <input type="location" name="location" class="form-control" id="location"  placeholder="Location">
    </div>
    <div class="form-group">
        <label for="room">Room:</label>
        <input type="file" class="form-control" name="room"/>
    </div>
    {{Form::submit('Save', ['class' => 'btn btn-success'])}}
  {!! Form::close() !!}

@endsection
