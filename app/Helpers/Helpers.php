<?php

if (!function_exists('respond')){
  function respond($data, $status_code = 200, $headers =[]){
    return response()->json($data, $status_code, $headers);
  }
}

if (!function_exists('success')){
  function success($message = "", $status_code = 200){
    return respond($message, $status_code);
  }
}

if (!function_exists('no_content')){
  function no_content($message = "", $status_code = 204){
    return respond($message, $status_code);
  }
}

if (!function_exists('current_user')){
  function current_user(){
    return Auth::user();
  }
}

if (!function_exists('user_id_available')){
  function user_id_available(){
    if(current_user()){
      return current_user()->id;
    }
    return 0;
  }
}

if (!function_exists('is_admin')){
  function is_admin(){
    if(current_user()){
      return current_user()->type;
    }
    return 0;
  }
}

if (!function_exists('is_logged_in')){
  function is_logged_in(){
    if(current_user()){
      return true;
    }
    return false;
  }
}
