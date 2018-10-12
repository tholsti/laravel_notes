<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;        // to include Request Object -> methods()


use DB;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    // CREATE NEW ENTRY TO DB
    public function create()
    {
        // prepare empty ARRAY[] data for EACH NOTE IN THE DB
        $note = [
            "id" => null,
            "title" => null,
            "topic" => null,
            "text" => null,
            "author" => null
        ];

        // display the 'FROM VIEW' in the 'view' in POSITION [view('url', ['name_to_var' => DB[$row] ])]
        $form = view('notes/edit', [
            'note' => $note,
        ]);

        // PUT the 'note' [$form] INTO its [DIV][HTML]['url'] name is as 'content'/'header/'footer'
        return view('notes/html_wrapper', [
            'content' => $form,     // PUT 'form_view' inside 'content'
        ]);
    }

    public function edit(Request $request)
    {
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

        // display the form
        $form = view('notes/edit', [
            'note' => $note
        ]);

        return view('notes/html_wrapper', [
            'content' => $form
        ]);
    }

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
                FROM `note`
                WHERE `id` = ?
                LIMIT 1
            ";
            
            //select($q, [$value1, $value2, ...]) SAVE $q IN AN $note[]
            $notes = DB::select($query, [$id]);
            // Returned Index[0]    {object} -> [array]
            $note = (array)$notes[0];

        } else {
            // B) this is insert
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

        // save THE data if (TRUE)
        if ($request->input('id')) {
            // update query
            $query = "
                UPDATE `notes`
                SET `title`  = ?,
                    `topic` = ?,
                    `text` = ?,
                    `author` = ?
                WHERE `id` = ?
            ";

            // array_slice(array $arr, int $offset, [int $length=NULL])  (NEGATIVE: starts from end !!!)
            // array_values(array $arr) -> MAKES IT KEYLESS NUMERICAL ARRAY

            $values = array_slice(array_values($note), 1); // all the pieces of $note except for the first ('id')
            $values[] = $note['id']; // append the id as the last item in $values (it is the last '?')
            // dd($values);

            // update(array $column, $values to INSERT)
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
