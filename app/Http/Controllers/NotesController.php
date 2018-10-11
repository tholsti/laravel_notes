<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function create() {
        // prepare empty data
        $note = [
            "title" =>null,
            "author" =>null,
            "topic" =>null,
            "text" =>null,
            "id" => null
        ];

        // display the note
        $form = view('notes/edit', [
            'note' => $note
        ]);

        return view('notes/html_wrapper', [
            'content' => $form
        ]);
    }

    public function edit() {

    }

    public function store() {

    }
}
