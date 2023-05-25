<?php

namespace App\Http\Controllers;

use App\Models\Lite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrashedNoteController extends Controller
{
    //

    public function index(){

        $notes = Lite::whereBelongsTo(Auth::user())->onlyTrashed()->latest('updated_at')->paginate(5);

        return view('notes.index')->with('notes',$notes);

    }

    public function show(Lite $note){
        // dd($note);

        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }
        return view('notes.show')->with('note',$note);

    }

    public function update(Lite $note)
    {
        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }
        $note->restore();
        return to_route('notes.show', $note)->with('success','Note restored');
    }


    public function destory(Lite $note){
        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }

        $note->forceDelete();

        return to_route('trashed.index')->with('success','Note deleted forever');

    }
}
