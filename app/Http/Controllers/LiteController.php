<?php

namespace App\Http\Controllers;

use App\Models\Lite;
use App\Models\Note;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $userId = Auth::id();
        // $notes = Lite::where('user_id', $userId)->latest('updated_at')->paginate(5);

        // $notes = Auth::user()->lites()->latest('updated_at')->paginate(5);

        $notes = Lite::whereBelongsTo(Auth::user())->latest('updated_at')->paginate(5);
        // // dd($notes);
        // $notes->each(function ($note) {
        //     dump($note->title);
        // });
        return view('notes.index')->with('notes',$notes);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        //
        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required'
        ]);

        Auth::user()->lites()->create([
            'uuid' => Str::uuid(),
            'title' => $request->title,
            'text' => $request->text
        ]);

        // $note->save();
        return to_route('notes.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Lite $note)
    {
        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }
        // $note = Lite::where('uuid', $uuid)->where('user_id', Auth::id())->firstOrFail();
        return view('notes.show', )->with('note', $note);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Lite $note)
    {

        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }
        // $note = Lite::where('uuid', $uuid)->where('user_id', Auth::id())->firstOrFail();
        return view('notes.edit', )->with('note', $note);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lite $note)
    {
        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }
        //
        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required'
        ]);

        $note->update([
            'title' => $request->title,
            'text' => $request->text
        ]);

        // $note->save();
        return to_route('notes.show', $note)->with('success','Note updated successfully');
        // dd($request);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lite $note)
    {
        // if ($note->user_id != Auth::id())
        if (!$note->user->is(Auth::user())) {

            return abort(403);
        }

        $note->delete();

        return to_route('notes.index')->with('success','Note Moved to Trash');;

        //
    }
}
