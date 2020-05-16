<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Results;
use Storage;
use Auth;
class ResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $results = Results::orderBy('id','asc')->get();
        return view("pages.results")->with('results',$results);
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
            $path = $request->file('file')->storeAs('public/results', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        $result = new Results;
        $result->department = $request->department;
        $result->batch = $request->batch;
        $result->sem = $request->sem;
        $result->monthyear = $request->monthyear;
        $result->type = $request->type;
        $result->file = $fileNameToStore;
        $result->save();
        return redirect(route('results.index'))->withStatus(__('Result Published.'));
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
        $result = Results::find($id);
        if (!isset($result)){
            return redirect('/results')->withError('No result Found');
        }
            // Check for correct user
        if(auth()->user()->user_type !== "faculty"){
            return redirect('/results')->withError('Unauthorized Page');
        }
    
        if($result->file != 'noimage.jpg'){
        // Delete Image
            Storage::delete('public/results/'.$result->file);
        }
            
        $result->delete();
        return redirect('/results')->withStatus('Result Removed');
    }
}
