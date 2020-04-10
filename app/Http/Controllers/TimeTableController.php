<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TimeTable;
use Auth;

class TimeTableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->user_type == 'student')
            {
                $timetable = TimeTable::where('department',Auth::user()->department)->where('batch',Auth::user()->batch)->paginate(10); 
                return view('pages.table_list')->with('timetable',$timetable);
            }
            return view('pages.table_list');
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
        $timetable = new TimeTable;
        $timetable->day = $request->day;
        $timetable->time = $request->time;
        $timetable->department = $request->department;
        $timetable->batch = $request->batch;
        $timetable->type = $request->type;
        $timetable->subject = $request->subject;
        $timetable->faculty = $request->faculty;
        $timetable->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
