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
    
    function formatSize($bytes)
    {
        $kb = 1024;
        $mb = $kb * 1024;
        $gb = $mb * 1024;
        $tb = $gb * 1024;
        if (($bytes >= 0) && ($bytes < $kb)) {
            return $bytes . ' B';
        } elseif (($bytes >= $kb) && ($bytes < $mb)) {
            return ceil($bytes / $kb) . ' KB';
        } elseif (($bytes >= $mb) && ($bytes < $gb)) {
            return ceil($bytes / $mb) . ' MB';
        } elseif (($bytes >= $gb) && ($bytes < $tb)) {
            return ceil($bytes / $gb) . ' GB';
        } elseif ($bytes >= $tb) {
            return ceil($bytes / $tb) . ' TB';
        } else {
            return $bytes . ' B';
        }
    }

    public function index()
    {
        if (Auth::user()->user_type == 'faculty') 
        {
            $tnotes = Notes::where('department',Auth::user()->department)->where('user_id',Auth::id())->get();
            $notes = Notes::where('department',Auth::user()->department)->get();
            return view('pages.notes')->with('tnotes',$tnotes)->with('notes',$notes);
        }
        $notes = Notes::where('department',Auth::user()->department)->get();
        return view('pages.notes')->with('notes',$notes);
        //return $tnotes.''.$notes.$pnotes;
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
            $sizestr = Storage::size('/public'.'/notes'.'/'.Auth::id().'/'.$fileNameToStore);
            $size =$this->formatSize($sizestr);
        } else {
            $fileNameToStore = 'nonote.txt';
        }
        $note = new Notes;
        $note->user_id = Auth::id();
        /* if (Auth::user()->user_type == "student") 
        {
            $note->department = Auth::user()->department;
            $note->batch = Auth::user()->batch;
        }
        else
        {
            
        } */
        $note->department = $request->department;
            $note->batch = $request->batch;
        $note->sem = $request->sem;
        $note->subject = $request->subject;
        $note->description = $request->description;
        $note->type = $request->type;
        $note->file = $fileNameToStore;
        $note->size = $size;
        $note->save();
        return redirect(route('notes.index'))->withStatus(__('Notes Published.'));
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
    public function destroy(Request $request,$id)
    {
        $note = Notes::find($id);
        if($note->user_id == Auth::id())
        {
            $note->delete();
            Storage::delete('/public'.'/notes'.'/'.Auth::id().'/'.$note->file);
            return redirect(route('notes.index'))->withStatus(__('Notes Deleted.'));
        }

    }
}
