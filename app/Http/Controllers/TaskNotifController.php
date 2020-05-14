<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\TasknNote;
class TaskNotifController extends Controller
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
        $tasknotes = TasknNote::where('user_id',Auth::id())->get();
        return view('dashboard')->with('tasknotes',$tasknotes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "".Auth::user()->tasknote;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->type == "Notice" || $request->type == "HomeWork" || $request->type == "Reminder") 
        {
            if(Auth::user()->user_type == "faculty")
            {
                if($request->type == "Notice" || $request->type == "HomeWork" )
                {
                    $newuniqueid = 0 ;
                    $previous = TasknNote::orderBy('created_at','desc')->first();
                    if(empty($previous))
                    {
                        $newuniqueid=1;
                    }
                    else
                    {

                        $newuniqueid=$previous->uniqueid+1;
                    }
                    $tasknote= new TasknNote;
                    $tasknote->user_id = Auth::id();
                    $tasknote->uniqueid = $newuniqueid;
                    $tasknote->department = $request->department;
                    $tasknote->batch = $request->batch;
                    $tasknote->subject = $request->subject;
                    $tasknote->read = 'done';
                    $tasknote->description = $request->description;
                    $tasknote->type= $request->type;
                    $tasknote->save();
                    
                    $users = User::where('department',$request->department)->where('batch',$request->batch)->get();
                    foreach ($users as $user ) 
                    {
                        $tasknote= new TasknNote;
                        $tasknote->user_id = $user->id;
                        $tasknote->uniqueid = $newuniqueid;
                        $tasknote->department = $request->department;
                        $tasknote->batch = $request->batch;
                        $tasknote->subject = $request->subject;
                        $tasknote->read = 'undone';
                        $tasknote->description = $request->description;
                        $tasknote->type= $request->type;
                        $tasknote->save();
                    }
                    return redirect('/home')->withStatus($request->type.' Posted.');
                }
                
            }
            else {
                return "Not Allowed";
            }
        }
        else 
        {
            return $request;    
        }
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
