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
Route::post("/jukebox/songs/insert", "SongsController@store");

Route::get("/jukebox/songs/edit", "SongsController@edit");
Route::post("/jukebox/songs/edit", "SongsController@store");

Route::get("/jukebox/songs/list", "SongsController@list");

Route::get("/jukebox/songs/delete", "SongsController@delete");
Route::post("/jukebox/songs/delete", "SongsController@delete");

Route::get("/", "JukeboxController@list");
Route::get("/player", "JukeboxController@player");