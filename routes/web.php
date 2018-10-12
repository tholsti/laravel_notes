<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/notes/create', 'NotesController@create');
Route::post("/notes/create", "NotesController@store");

Route::get("/notes/edit", "NotesController@edit");
Route::post("/notes/edit", "NotesController@store");

Route::get("/jukebox/songs/insert", "SongsController@create");