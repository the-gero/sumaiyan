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
    function folderSize($dir){
        $total_size = 0;
        $count = 0;
        $dir_array = scandir($dir);
          foreach($dir_array as $key=>$filename){
            if($filename!=".." && $filename!="."){
               if(is_dir($dir."/".$filename)){
                  $new_foldersize = foldersize($dir."/".$filename);
                  $total_size = $total_size+ $new_foldersize;
                }else if(is_file($dir."/".$filename)){
                  $total_size = $total_size + filesize($dir."/".$filename);
                  $count++;
                }
           }
         }
        return $total_size;
        }
    public function index()
    {
        $tasknotes = TasknNote::where('user_id', Auth::id())->orderBy("updated_at", "asc")->get();
        $size = $this->folderSize('storage/notes/'.Auth::id());
        $sizewithformat = $this->formatSize($size);
        
        if (Auth::user()->user_type == "faculty") {
            $undonehws = TasknNote::where('read', "undone")->where('type', "homework")->where("department", Auth::user()->department)->orderBy("updated_at", "asc")->get();
            return view('dashboard')->with('tasknotes', $tasknotes)->with('undonehws', $undonehws)->with('size',$sizewithformat);
        }
        return view('dashboard')->with('tasknotes', $tasknotes)->with('size',$sizewithformat);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "" . Auth::user()->tasknote;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->type == "Notice" || $request->type == "HomeWork" || $request->type == "Reminder") {
            if (Auth::user()->user_type == "faculty") {
                if ($request->type == "Notice" || $request->type == "HomeWork") {
                    $newuniqueid = 0;
                    $previous = TasknNote::orderBy('created_at', 'desc')->first();
                    if (empty($previous)) {
                        $newuniqueid = 1;
                    } else {

                        $newuniqueid = $previous->uniqueid + 1;
                    }
                    $tasknote = new TasknNote;
                    $tasknote->user_id = Auth::id();
                    $tasknote->uniqueid = $newuniqueid;
                    $tasknote->department = $request->department;
                    $tasknote->batch = $request->batch;
                    $tasknote->subject = $request->subject;
                    $tasknote->read = 'done';
                    $tasknote->description = $request->description;
                    $tasknote->type = $request->type;
                    $tasknote->save();

                    $users = User::where('department', $request->department)->where('batch', $request->batch)->get();
                    foreach ($users as $user) {
                        $tasknote = new TasknNote;
                        $tasknote->user_id = $user->id;
                        $tasknote->uniqueid = $newuniqueid;
                        $tasknote->department = $request->department;
                        $tasknote->batch = $request->batch;
                        $tasknote->subject = $request->subject;
                        $tasknote->read = 'undone';
                        $tasknote->description = $request->description;
                        $tasknote->type = $request->type;
                        $tasknote->save();
                    }
                    return redirect('/home')->withStatus($request->type . ' Posted.');
                }
            } else {
                return "Not Allowed";
            }
        } else {
            $newuniqueid = 0;
            $previous = TasknNote::orderBy('created_at', 'desc')->first();
            if (empty($previous)) {
                $newuniqueid = 1;
            } else {
                $newuniqueid = $previous->uniqueid + 1;
            }
            $tasknote = new TasknNote;
            $tasknote->user_id = Auth::id();
            $tasknote->uniqueid = $newuniqueid;
            $tasknote->department = Auth::user()->department;
            $tasknote->batch = Auth::user()->batch;
            $tasknote->subject = $request->subject;
            $tasknote->read = 'undone';
            $tasknote->description = $request->description;
            $tasknote->type = $request->type;
            $tasknote->save();
            return redirect('/home')->withStatus($request->type . ' Added.');
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->type == "Task") {
            try {
                $note = TasknNote::where("user_id", Auth::id())->where("uniqueid", $id)->first();
                $note->delete();
                return redirect('/home')->withStatus($request->type . ' Removed.');
            } catch (Exception $e) {
                return redirect('/home')->withStatus($request->type . ' Not yours.');
            }
        }
        if ($request->type == "Notice") {
            try {
                if (Auth::user()->user_type == "faculty") {
                    $notes = TasknNote::where("uniqueid", $id)->get();
                    foreach ($notes as $note) {
                        $note->delete();
                    }
                    return redirect('/home')->withStatus($request->type . ' Removed.');
                } else {
                    return redirect('/home')->withStatus('Access Denied.');
                }
            } catch (Exception $e) {
                return redirect('/home')->withStatus($request->type . ' Not yours.' . $e);
            }
        }

        if ($request->type == "HomeWork") {
            try {
                if (Auth::user()->user_type == "faculty") {
                    $notes = TasknNote::where("uniqueid", $id)->get();
                    foreach ($notes as $note) {
                        $note->delete();
                    }
                    return redirect('/home')->withStatus($request->type . ' Removed.');
                } else {
                    return redirect('/home')->withStatus('Access Denied.');
                }
            } catch (Exception $e) {
                return redirect('/home')->withStatus($request->type . ' Not yours.' . $e);
            }
        }
    }
}
