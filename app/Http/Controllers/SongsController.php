<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;

class SongsController extends Controller
{
    // CREATE NEW ENTRY TO DB
    public function create()
    {
        // prepare empty ARRAY[] data for EACH NOTE IN THE DB
        $song = [
            "id" => null,
            "song_title" => null,
            "artist" => null,
            "youtube_link" => null,
            "genre" => null,
            "date_of_upload" => null,
            "youtube_url" => null,
            "youtube_embed" => null
        ];

        // display the 'FROM VIEW' in the 'view' in POSITION [view('url', ['name_to_var' => DB[$row] ])]
        $form = view('jukebox/songs/insert', [
            'song' => $song,
        ]);

        // PUT the 'note' [$form] INTO its [DIV][HTML]['url'] name is as 'content'/'header/'footer'
        return view('jukebox/songs/html_wrapper', [
            'content' => $form,     // PUT 'form_view' inside 'content'
        ]);
    }

    
    // STORE THE DATA IN THE DB
    public function store(Request $request)
    {  
         // ({object_instance} -> input($_GET/$POST['id']))
        if ($request->input('id')) {

            // this is edit
            // A) retrieve the record from database (via GET OR POST method 'id')
            $id = $request->input('id');
            
            // B) GET the QUERY ready to ASSIGN DATA 
            $query = "
                SELECT *
                FROM `songs`
                WHERE `id` = ?
                LIMIT 1
            ";
            
            //select($q, [$value1, $value2, ...]) SAVE $q IN AN $note[]
            $songs = DB::select($query, [$id]);
            // Returned Index[0]    {object} -> [array]
            $song = (array)$songs[0];

        } else {
            // B) this is insert
            // prepare empty data
            $query = [
                "song_title" => null,
                "artist" => null,
                "youtube_link" => null,
                "genre" => null,
                "date_of_upload" => null,
                "youtube_url" => null,
                "youtube_embed" => null,
                "id" => null
            ];
        }

        // update the $note[$key]    with what was submitted
        foreach ($song as $key => $value) { // loop through data in $note
            if ($request->has($key)) { // if there is something WITH THE SAME $KEY  in $_POST
                $song[$key] = $request->input($key); // update the data in $note with it
            }
        }

        // save THE data if (TRUE)
        if ($request->input('id')) {
            // update query
            $query = "
                UPDATE `song`
                SET `song_title' = ?,
                    `artist'  = ?,
                    `youtube_link' = ?,
                    `genre' = ?,
                    `date_of_upload' = ?,
                    `youtube_url' = ?,
                    `youtube_embed' = ?
                WHERE `id` = ?
            ";

            // array_slice(array $arr, int $offset, [int $length=NULL])  (NEGATIVE: starts from end !!!)
            // array_values(array $arr) -> MAKES IT KEYLESS NUMERICAL ARRAY

            $values = array_slice(array_values($song), 1); // all the pieces of $note except for the first ('id')
            $values[] = $song['id']; // append the id as the last item in $values (it is the last '?')
            // dd($values);

            // update(array $column, $values to INSERT)
            DB::update($query, $values);
        } else {
            // insert query
            $query = "
                INSERT
                INTO `song`
                (`song_title`, `artist`, `youtube_link`, `genre`,
                date_of_upload, youtube_url, youtube_embed)
                VALUES
                (?, ?, ?, ?)
            ";
            DB::update($query, array_slice(array_values($song), 1));

            $new_inserted_id = DB::getPdo()->lastInsertId();

            // update the $note so that it matche the inserted id
            $song['id'] = $new_inserted_id;
        }

        // inform user (it must survive redirection)
        session()->flash('success_message', 'Success! You have saved it!');

        // redirect
        return redirect('notes/edit?id=' . $song['id']);
    }

    // EDIT DATA IN THE DB
    public function edit(Request $request)
    {
        // retrieve the record from database
        $id = $request->input('id');
        $query = "
            SELECT *
            FROM `song`
            WHERE `id` = ?
            LIMIT 1
        ";

        $songs = DB::select($query, [$id]);
        $song = (array)$songs[0];

        // display the form
        $form = view('jukebox/songs/edit', [
            'note' => $note
        ]);

        return view('jukebox/songs/html_wrapper', [
            'content' => $form
        ]);

    }

}
