<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notes;
use Auth;
use Storage;
class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    
    public function index()
    {
        if (Auth::user()->user_type == 'faculty') 
        {
            $tnotes = Notes::where('department',Auth::user()->department)->where('user_id',Auth::id())->get();
            $notes = Notes::where('department',Auth::user()->department)->where('type','Public')->get();
            return view('pages.notes')->with('tnotes',$tnotes)->with('notes',$notes);
        }
        $notes = Notes::where('department',Auth::user()->department)->where('batch',Auth::user()->batch)->where('type','Public')->get();
        $pnotes = Notes::where('department',Auth::user()->department)->where('batch',Auth::user()->batch)->where('type','Private')->get();
        return view('pages.notes')->with('notes',$notes)->with('pnotes',$pnotes);
        return $tnotes.''.$notes.$pnotes;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('file')){
            // Get filename with the extension
            $filenameWithExt = $request->file('file')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('file')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('file')->storeAs('public/notes/'.Auth::id(), $fileNameToStore);
            $size = Storage::size('/public'.'/notes'.'/'.Auth::id().'/'.$fileNameToStore);
        } else {
            $fileNameToStore = 'nonote.txt';
        }
        $note = new Notes;
        $note->user_id = Auth::id();
        $note->department = $request->department;
        $note->batch = $request->batch;
        $note->sem = $request->sem;
        $note->subject = $request->subject;
        $note->description = $request->description;
        $note->type = $request->type;
        $note->file = $fileNameToStore;
        $note->size = $size;
        $note->save();
        return back()->withStatus(__('Notes Published.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
