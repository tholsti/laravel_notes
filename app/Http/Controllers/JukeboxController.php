<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class JukeboxController extends Controller
{
    public function list() {
        // retrieve all records from DB
        $query = "
            SELECT *
            FROM `songs`
            WHERE 1
        ";

        $songs = DB::select($query);
        
        for ($i = 0 ; $i < count($songs) ; $i++)
        {
        $song[] = (array)$songs[$i];
        }

        $list = view("jukebox.main", [
            "songs" => $song
        ]);
        
        return view('jukebox.html_wrapper', [
            'content' => $list
        ]);
    }

    public function player(Request $request) {
        $query = "
            SELECT *
            FROM `songs`
            WHERE id = ?
        ";
        
        $id = $request->input('id');
        
        $songs = DB::select($query, [$id]);
        $song = (array)$songs[0];
        // $player = (array)$songs[0];

        return view ("jukebox.player", [
            "embed" => $song
        ]);
            
    }
}
