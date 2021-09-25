<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login','UserController@login');
Route::post('/register','UserController@register');

Route::group(["middleware" => "auth:users_jwt"], function(){
    Route::get('/logout','UserController@logout');
    Route::get('/me','UserController@me');
});
