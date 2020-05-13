@extends('layouts.app', ['activePage' => 'notes', 'titlePage' => __('Notes')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header card-header-primary">
        <h1 class="card-title">Notes</h1>
        <p class="card-category">Get your notes here or post your own notes.</p>
      </div>
      <br>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header card-header-info">
                <h2 class="card-title">Teachers Notes</h2>
              </div>
              <div class="card-body">
                @if( Auth::user()->user_type == 'faculty' && count($tnotes)>0)
                  @foreach($tnotes as $tnote)
                  <div @if(Auth::user()->id == $tnote->user_id) class="alert alert-warning" @else class="alert alert-success" @endif>
                    <div class="row">
                      <div class="col-sm-3">
                        Subject :{{$tnote->subject}}
                      </div>
                      <div class="col-sm-4">
                        Description :{{$tnote->description}}
                      </div>
                      <div class="col-sm-2">
                         <a href="/storage/notes/{{$tnote->user_id}}/{{$tnote->file}}" target="_blank"><button class="btn "> Get notes</button></a> 
                      </div>
                    </div>
                    <span><small class="float-right">by {{$tnote->user->name}} from @if($tnote->user->batch == "") {{$tnote->user->department}} @else {{$tnote->user->batch}}  @endif</small></span> 
                  </div>
                  @endforeach
                @endif
                @if( count($notes)>0)
                  @foreach($notes as $note)
                    @if($note->user_id != Auth::id())
                      <div @if(Auth::user()->id == $note->user_id) class="alert alert-primary" @else class="alert alert-success" @endif>
                        <div class="row">
                          <div class="col-sm-3">
                            Subject :{{$note->subject}}
                          </div>
                          <div class="col-sm-4">
                            Description :{{$note->description}}
                          </div>
                          <div class="col-sm-2">
                            <a href="/storage/notes/{{$note->user_id}}/{{$note->file}}" target="_blank"><button class="btn "> Get notes</button></a> 
                          </div>
                          
                        </div>
                        <span class="justify-content-end  ">
                          <small class="float-right">by {{$note->user->name}}  @if($note->user->batch == "") from {{$note->user->department}} @else {{$note->user->batch}}  @endif </small></span> 
                      </div>
                    @endif
                  @endforeach
                @endif
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header card-header-info row">
                <h2 class="card-title col">My Notes </h2>
                <button class="btn btn-danger col" data-toggle="modal" data-target="#addnote">  Add new </button>
              </div>
              <div class="card-body" style="overflow: auto; ">
                @if( count($notes)>0)
                  @foreach($notes as $note)
                    @if($note->user_id == Auth::id())
                      <div @if(Auth::user()->id == $note->user_id) class="alert alert-primary" @else class="alert alert-success" @endif>
                        <div class="row">
                          <div class="col-sm-3">
                            Subject :{{$note->subject}}
                          </div>
                          <div class="col-sm-4">
                            Description :{{$note->description}}
                          </div>
                          <div class="col-sm-2">
                            <a href="/storage/notes/{{$note->user_id}}/{{$note->file}}" target="_blank"><button class="btn "> Get notes</button></a> 
                          </div>
                        </div>
                        
                      </div>
                    @endif
                  @endforeach
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- <div class="col-md-12">
        <div class="places-buttons">
          <div class="row">
            <div class="col-md-6 ml-auto mr-auto text-center">
              <h4 class="card-title">
                Notes Places
                <p class="category">Click to view Notes</p>
              </h4>
            </div>
          </div>
        </div>
      </div> --}}
    </div>
  </div>
</div>
<div class="modal fade table " id="addnote" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog " role="document">
    <div class="modal-content card">
      <div class="modal-header card-header card-header-primary">
        <h4 class="modal-title card-title" id="myModalLabel">Add Notes</h4>
        <button type="button" class="close float-left" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
        <div class="modal-body card-body">
          
          <form method="post" action="#" enctype="multipart/form-data" autocomplete="off" class="form">
            @csrf
            <input type="hidden" name="noteid" id="noteid" value="">
            
                <div class="row  bmd-form-group{{ $errors->has('department') ? ' has-danger' : '' }} mt-3">
                  <div class="input-group">
                    <div class="input-group-prepend col-sm-3 col-form-label">
                      <span class="input-group-text ">
                        <i class="material-icons">account_balance</i>
                      </span>
                    </div>
                      <input class="btn dropdown-toggle col-md-6" type="text" readonly name="department" id="department" value="{{ __('Department...') }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required>
                      <div class="dropdown-menu" aria-labelledby="department">
                        <a class="dropdown-item" onclick="document.getElementById('department').setAttribute('value','Computer Science');" >Computer Science</a>
                        <a class="dropdown-item" onclick="document.getElementById('department').setAttribute('value','Information Technology');" >Information Technology</a>
                      </div>
                    
                  </div>
                  @if ($errors->has('department'))
                    <div id="department-error" class="error text-danger pl-3" for="department" style="display: block;">
                    <strong>{{ $errors->first('department') }}</strong>
                    </div>
                  @endif
                </div>
                <div class="row bmd-form-group{{ $errors->has('batch') ? ' has-danger' : '' }} mt-3">
                  <div class="input-group">
                    <div class="input-group-prepend col-sm-3 col-form-label">
                      <span class="input-group-text">
                        <i class="material-icons">class</i>
                      </span>
                    </div>
                      <input class="btn dropdown-toggle col-md-6" type="text" readonly name="batch" id="batch" value="{{ __('Batch...') }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required  >
                      <div class="dropdown-menu" aria-labelledby="batch">
                        <a class="dropdown-item" onclick="document.getElementById('batch').setAttribute('value','First Year');" >First Year</a>
                        <a class="dropdown-item" onclick="document.getElementById('batch').setAttribute('value','Second Year');" >Second Year</a>
                        <a class="dropdown-item" onclick="document.getElementById('batch').setAttribute('value','Third Year');">Third Year</a>
                      </div>
                  </div>
                  
                  @if ($errors->has('batch'))
                    <div id="batch-error" class="error text-danger pl-3" for="batch" style="display: block;">
                    <strong>{{ $errors->first('batch') }}</strong>
                    </div>
                  @endif
                </div>
                <div class="row bmd-form-group{{ $errors->has('sem') ? ' has-danger' : '' }} mt-3">
                  <div class="input-group">
                    <div class="input-group-prepend col-sm-3 col-form-label">
                      <span class="input-group-text">
                        <i class="material-icons">timelapse</i>
                      </span>
                    </div>
                      <input class="btn dropdown-toggle col-md-6 " type="text" readonly name="sem" id="sem" value="{{ __('Sem...') }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required  >
                      <div class="dropdown-menu" aria-labelledby="sem">
                        <a class="dropdown-item" onclick="document.getElementById('sem').setAttribute('value','I');" >I</a>
                        <a class="dropdown-item" onclick="document.getElementById('sem').setAttribute('value','II');" >II</a>
                        <a class="dropdown-item" onclick="document.getElementById('sem').setAttribute('value','III');">III</a>
                        <a class="dropdown-item" onclick="document.getElementById('sem').setAttribute('value','IV');">IV</a>
                        <a class="dropdown-item" onclick="document.getElementById('sem').setAttribute('value','V');">V</a>
                        <a class="dropdown-item" onclick="document.getElementById('sem').setAttribute('value','VI');">VI</a>
                        
                      </div>
                  </div>
                  
                  @if ($errors->has('sem'))
                    <div id="sem-error" class="error text-danger pl-3" for="sem" style="display: block;">
                    <strong>{{ $errors->first('sem') }}</strong>
                    </div>
                  @endif
                </div>
                <div class="row bmd-form-group{{ $errors->has('description') ? ' has-danger' : '' }} mt-3">
                  <div class="input-group">
                    <div class="input-group-prepend col-sm-3 col-form-label">
                      <span class="input-group-text">
                        <i class="material-icons">description</i>
                      </span>
                    </div>
                      <input class="btn col-md-6 from"  type="textarea"  name="description" id="description" placeholder="{{ __('Description...') }}"   {{-- data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" --}} required  >
                  </div>
                  
                  @if ($errors->has('description'))
                    <div id="description-error" class="error text-danger pl-3 "  style="display: block;">
                    <strong>{{ $errors->first('description') }}</strong>
                    </div>
                  @endif
                </div>
                <div class="row bmd-form-group{{ $errors->has('subject') ? ' has-danger' : '' }} mt-3">
                  <div class="input-group">
                    <div class="input-group-prepend col-sm-3 col-form-label">
                      <span class="input-group-text">
                        <i class="material-icons">subject</i>
                      </span>
                    </div>
                      <input class="btn col-md-6 from"  type="text"  name="subject" id="subject" placeholder="{{ __('subject...') }}"   {{-- data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" --}} required  >
                  </div>
                  
                  @if ($errors->has('subject'))
                    <div id="subject-error" class="error text-danger pl-3 "  style="display: block;">
                    <strong>{{ $errors->first('subject') }}</strong>
                    </div>
                  @endif
                </div>
                <div class="row bmd-form-group{{ $errors->has('type') ? ' has-danger' : '' }} mt-3">
                  <div class="input-group">
                    <div class="input-group-prepend col-sm-3 col-form-label">
                      <span class="input-group-text">
                        <i class="material-icons">remove_red_eye</i>
                      </span>
                    </div>
                      <input class="btn dropdown-toggle col-md-6" type="text" readonly name="type" id="type" value="{{ __('Privacy...') }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required  >
                      <div class="dropdown-menu" aria-labelledby="type">
                        @if(Auth::user()->user_type)<a class="dropdown-item" onclick="document.getElementById('type').setAttribute('value','Private');" >Private</a> @endif
                        <a class="dropdown-item" onclick="document.getElementById('type').setAttribute('value','Public');" >Public</a>
                      </div>
                  </div>
                  
                  @if ($errors->has('type'))
                    <div id="type-error" class="error text-danger pl-3" for="type" style="display: block;">
                    <strong>{{ $errors->first('type') }}</strong>
                    </div>
                  @endif
                </div>
                <div class="row bmd-form-group{{ $errors->has('file') ? ' has-danger' : '' }} mt-3">
                  <div class="input-group">
                    <div class="input-group-prepend col-sm-3 col-form-label">
                      <span class="input-group-text">
                        <i class="material-icons">attach_file</i>
                      </span>
                    </div>
                      <input class="btn col-md-6" accept=".pdf" for="file"  type="file"  name="file" id="file" value="{{ __('Upload File...') }}"   {{-- data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" --}} required  >
                  </div>
                  
                  @if ($errors->has('file'))
                    <div id="file-error" class="error text-danger pl-3 " for="file" style="display: block;">
                    <strong>{{ $errors->first('file') }}</strong>
                    </div>
                  @endif
                </div>
                <div class="card-footer ml-auto mr-auto justify-content-center">
                  <button type="submit" class="btn btn-primary ">{{ __('Post Notes') }}</button>
                </div>
              </form>
            </div>
          
    </div>
  </div>
</div>
</div>
@endsection
