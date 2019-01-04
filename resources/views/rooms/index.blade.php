@extends('layouts.master')

@section('master')

  <rooms-component is-logged-in="{{is_logged_in()}}" user-id={{user_id_available()}} is-admin="{{is_admin()}}"></rooms-component>
  <?php
  if(is_logged_in())
  { ?>
  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Logged In As <i><?php echo ucfirst(current_user()->name) ?></i>
  </a>
  <?php } else { ?>
  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Logged In As <i>Guest</i>
  </a>
  <?php } ?>
    <a class="btn btn-danger" href="{{route("logout")}}" role="button" value="Logout">Logout</a>
    <a class="btn btn-primary" href="{{route("rooms.create")}}" role="button" value="Create Listing">Create Listing</a>


@endsection
