<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function create()
    {
        // prepare empty data
        $note = [
            "id" => null,
            "title" => null,
            "topic" => null,
            "text" => null,
            "author" => null
        ];

        // display the note
        $form = view('notes/edit', [
            'note' => $note,
        ]);

        return view('notes/html_wrapper', [
            'content' => $form,
        ]);
    }

    public function edit()
    {

    }

    public function store(Request $request)
    {
        if ($request->input('id')) {
            // this is edit
            // retrieve the record from database
            $id = $request->input('id');
            $query = "
                SELECT *
                FROM `notes`
                WHERE `id` = ?
                LIMIT 1
            ";
            $notes = DB::select($query, [$id]);
            $note = (array)$notes[0];

        } else {
            // this is insert
            // prepare empty data
            $note = [
                "id" => null,
                "title" => null,
                "topic" => null,
                "text" => null,
                "author" => null
            ];
        }

        // update the $note with what was submitted
        foreach ($note as $key => $value) { // loop through data in $note
            if ($request->has($key)) { // if there is something with the same key in $_POST
                $note[$key] = $request->input($key); // update the data in $note with it
            }
        }

        // save data
        if ($request->input('id')) {
            // update query
            $query = "
                UPDATE `notes`
                SET `title'  = ?,
                    `topic' = ?,
                    `text' = ?,
                    `author' = ?
                WHERE `id` = ?
            ";
            $values = array_slice(array_values($note), 1); // all the pieces of $game except for the first ('id')
            $values[] = $note['id']; // append the id as the last item in $values (it is the last '?')
            // dd($values);
            DB::update($query, $values);
            
        } else {
            // insert query
            $query = "
                INSERT
                INTO `notes`
                (`title`, `topic`, `text`, `author`)
                VALUES
                (?, ?, ?, ?)
            ";
            DB::update($query, array_slice(array_values($note), 1));

            $new_inserted_id = DB::getPdo()->lastInsertId();

            // update the $note so that it matche the inserted id
            $note['id'] = $new_inserted_id;
        }

        // inform user (it must survive redirection)
        session()->flash('success_message', 'Success! You have saved it!');

        // redirect
        return redirect('notes/edit?id=' . $note['id']);
    }
}
