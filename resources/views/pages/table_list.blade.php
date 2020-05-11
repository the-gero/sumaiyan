@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Time Table')])

@section('content')
<div class="content">
        @if (session('status'))
          <div class="row">
            <div class="col-sm-12">
              <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <i class="material-icons">close</i>
                </button>
                <span>{{ session('status') }}</span>
              </div>
            </div>
          </div>
        @endif              
        @if(Auth::user()->user_type == "student")
        
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header card-header-primary">
                    <h4 class="card-title ">Time Table</h4>
                  <p class="card-category"> Here is your time table {{Auth::user()->name}}</p>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table">
                        <thead class=" text-primary">
                          <th>
                            Day
                          </th>
                          <th>
                            Time
                          </th>
                          <th>
                            Subject
                          </th>
                          <th>
                            Type
                          </th>
                          <th>
                            Faculty
                          </th>
                        </thead>
                        <tbody>
                          @foreach ($timetable as $item)
                          <tr>
                            <td>
                              {{$item->day}}
                            </td>
                            <td>
                              {{$item->time}}
                            </td>
                            <td>
                              {{$item->subject}}
                            </td>
                            <td>
                              {{$item->type}}
                            </td>
                            <td class="text-primary">
                              {{$item->faculty}}
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                        
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endif

        @if(Auth::user()->user_type == "faculty")
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Add Time Table</h4>
                <p class="card-category"> Here you can add time tables</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          Day
                        </th>
                        <th>
                          Time
                        </th>
                        <th>
                          Department
                        </th>
                        <th>
                          Batch
                        </th>
                        
                      </thead>
                      <tbody>
                        <form action="{{ route('time-table.store') }}" method="post" enctype="multipart/form-data" class="form">
                          @csrf
                          <tr>
                            <td><input type="text" name="day" id="day" class="btn dropdown-toggle" readonly value="{{ __('Day...') }}" style="color: white; background-color: purple;border-color: purple;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required >
                              <div class="dropdown-menu" aria-labelledby="day" >
                                <a class="dropdown-item" onclick="document.getElementById('day').setAttribute('value','Monday');" >Monday</a>
                                <a class="dropdown-item" onclick="document.getElementById('day').setAttribute('value','Tuesday');" >Tuesday</a>
                                <a class="dropdown-item" onclick="document.getElementById('day').setAttribute('value','Wednesday');" >Wednesday</a>
                                <a class="dropdown-item" onclick="document.getElementById('day').setAttribute('value','Thursday');" >Thursday</a>
                                <a class="dropdown-item" onclick="document.getElementById('day').setAttribute('value','Friday');" >Friday</a>
                                <a class="dropdown-item" onclick="document.getElementById('day').setAttribute('value','Saturdayday');" >Saturday</a>
                              </div>
                            </td>
                            <td><input type="time" class="btn dropdown-toggle"  name="time" id="time" style="/* border-radius:3px; border-width:14px; border-style:solid; */ color: white; background-color: purple;border-color: purple;" >
                              
                            </td>
                            <td><input class="btn dropdown-toggle" type="text" readonly name="department" id="department" style="color: white; background-color: purple;border-color: purple;" value="{{ __('Department...') }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required>
                              <div class="dropdown-menu" aria-labelledby="department">
                                <a class="dropdown-item"  onclick="document.getElementById('department').setAttribute('value','Computer Science');" >Computer Science</a>
                                <a class="dropdown-item" onclick="document.getElementById('department').setAttribute('value','Information Technology');" >Information Technology</a>
                              </div></td>
                            <td><input class="btn dropdown-toggle" type="text" readonly name="batch" id="batch" value="{{ __('Batch...') }}" style="color: white; background-color: purple;border-color: purple;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required  >
                              <div class="dropdown-menu" aria-labelledby="batch">
                                <a class="dropdown-item" onclick="document.getElementById('batch').setAttribute('value','First Year');" >First Year</a>
                                <a class="dropdown-item" onclick="document.getElementById('batch').setAttribute('value','Second Year');" >Second Year</a>
                                <a class="dropdown-item" onclick="document.getElementById('batch').setAttribute('value','Third Year');">Third Year</a>
                              </div>
                            </td>
                          </tr>
                          <thead class=" text-primary">
                            <th>
                              Type
                            </th>
                            <th>
                              Subject
                            </th>
                            <th>
                              Faculty
                            </th>
                            <th>
                              Action
                            </th>
                          </thead>
                          <tr>
                            <td><input type="text" name='type' id='type' class="btn dropdown-toggle" readonly value="{{ __('Type...') }}" style="color: white; background-color: purple;border-color: purple;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required >
                              <div class="dropdown-menu" aria-labelledby="type" >
                                <a class="dropdown-item" onclick="document.getElementById('type').setAttribute('value','Lecture');" >Lecture</a>
                                <a class="dropdown-item" onclick="document.getElementById('type').setAttribute('value','Practical');" >Practical</a>
                              </div>
                            </td>
                            <td><input type="text" name='subject' placeholder="Subject" class="btn dropdown-toggle" style="color: white; background-color: purple;border-color: purple;" ></td>
                            <td><input type="text" name='faculty' placeholder="Faculty" class="btn dropdown-toggle" style=" color: white; background-color: purple;border-color: purple;"  ></td>
                            <td><button type="submit" class="btn btn-primary btn-link btn-lg" ><span class="input-group-button" > <i class="material-icons">add</i></span> Add</button></form> </td>
                          </tr>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr>
  
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Existing Time Tables</h4>
                  <p class="card-category"> Here are the existing time tables.</p>
                </div>
                <div class="table-responsive">
                  @if(count($fulltts)>0)
                    <div id="accordion" class="accordion">
                        <style>
                          .accordion .card-header:after {
                              font-family: 'FontAwesome';  
                              content: "\f068";
                              float: right; 
                          }
                          .accordion .card-header.collapsed:after {
                              /* symbol for "collapsed" panels */
                              content: "\f067"; 
                          }
                        </style>
                        <div class="card mb-0">
                            <div class="card-header collapsed" data-toggle="collapse" href="#collapseOne">
                                <a class="card-title"> <h4> Computer Science TY</h4> </a>
                            </div>
                            <div id="collapseOne" class="card-body collapse" data-parent="#accordion">
                              <table class="table" id="CS-TY">
                                <thead class="text-primary">
                                  <th>
                                    Day
                                  </th>
                                  <th>
                                    Time
                                  </th>
                                  <th>
                                    Department
                                  </th>
                                  <th>
                                    Batch
                                  </th>
                                  <th>
                                    Type
                                  </th>
                                  <th>
                                    Subject
                                  </th>
                                  <th>
                                    Faculty
                                  </th>
                                  <th>
                                    Action
                                  </th>
                                </thead>
                                <tbody>
                                    @foreach($fulltts as $fulltt)
                                      @if($fulltt->department == "Computer Science" &&  $fulltt->batch == "Third Year")
                                        <tr>
                                          <td>{{$fulltt->day}}</td>
                                          <td>{{$fulltt->time}}</td>
                                          <td>{{$fulltt->department}}</td>
                                          <td>{{$fulltt->batch}}</td>
                                          <td>{{$fulltt->type}}</td>
                                          <td>{{$fulltt->subject}}</td>
                                          <td>{{$fulltt->faculty}}</td>
                                          <td><button class="btn btn-success" data-ttid="{{$fulltt->id}}" data-ttid="{{$fulltt->id}}" data-ttday="{{$fulltt->day}}" data-tttime="{{$fulltt->time}}" data-ttdepartment="{{$fulltt->department}}" data-ttbatch="{{$fulltt->batch}}" data-tttype="{{$fulltt->type}}" data-ttsubject="{{$fulltt->subject}}" data-ttfaculty="{{$fulltt->faculty}}" data-toggle="modal" data-target="#edit" >Update</button> 
                                              <button type="submit" class="btn btn-danger" data-ttid="{{$fulltt->id}}" data-toggle="modal" data-target="#delete">Delete</button>
                                        </td>
                                        </tr>
                                      @endif
                                    @endforeach
                                  </tbody>
                              </table>
                            </div>
                            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                <a class="card-title"> <h4>Information Technology TY</h4> </a>
                            </div>
                            <div id="collapseTwo" class="card-body collapse" data-parent="#accordion">
                              <table class="table" id="IT-TY">
                                <tbody>
                                  <thead class="text-primary">
                                    <th>
                                      Day
                                    </th>
                                    <th>
                                      Time
                                    </th>
                                    <th>
                                      Department
                                    </th>
                                    <th>
                                      Batch
                                    </th>
                                    <th>
                                      Type
                                    </th>
                                    <th>
                                      Subject
                                    </th>
                                    <th>
                                      Faculty
                                    </th>
                                    <th>
                                      Action
                                    </th>
                                  </thead>
                                <tbody>
                                    @foreach($fulltts as $fulltt)
                                      @if($fulltt->department == "Information Technology" &&  $fulltt->batch == "Third Year")
                                        <tr>
                                          <td>{{$fulltt->day}}</td>
                                          <td>{{$fulltt->time}}</td>
                                          <td>{{$fulltt->department}}</td>
                                          <td>{{$fulltt->batch}}</td>
                                          <td>{{$fulltt->type}}</td>
                                          <td>{{$fulltt->subject}}</td>
                                          <td>{{$fulltt->faculty}}</td>
                                          <td><button class="btn btn-success" data-ttid="{{$fulltt->id}}" data-ttid="{{$fulltt->id}}" data-ttday="{{$fulltt->day}}" data-tttime="{{$fulltt->time}}" data-ttdepartment="{{$fulltt->department}}" data-ttbatch="{{$fulltt->batch}}" data-tttype="{{$fulltt->type}}" data-ttsubject="{{$fulltt->subject}}" data-ttfaculty="{{$fulltt->faculty}}" data-toggle="modal" data-target="#edit">Update</button> 
                                              <button type="submit" class="btn btn-danger" data-ttid="{{$fulltt->id}}" data-toggle="modal" data-target="#delete">Delete</button>
                                        </td>
                                        </tr>
                                      @endif
                                    @endforeach
                                  </tbody>
                              </table>
                            </div>
                            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                <a class="card-title"> <h4>Computer Science SY</h4> </a>
                            </div>
                            <div id="collapseThree" class="collapse" data-parent="#accordion">
                              <div class="card-body">
                                <table class="table" id="CS-SY">
                                    <thead class="text-primary">
                                      <th>
                                        Day
                                      </th>
                                      <th>
                                        Time
                                      </th>
                                      <th>
                                        Department
                                      </th>
                                      <th>
                                        Batch
                                      </th>
                                      <th>
                                        Type
                                      </th>
                                      <th>
                                        Subject
                                      </th>
                                      <th>
                                        Faculty
                                      </th>
                                      <th>
                                        Action
                                      </th>
                                    </thead>
                                  <tbody>
                                      @foreach($fulltts as $fulltt)
                                        @if($fulltt->department == "Computer Science" &&  $fulltt->batch == "Second Year")
                                          <tr>
                                            <td>{{$fulltt->day}}</td>
                                            <td>{{$fulltt->time}}</td>
                                            <td>{{$fulltt->department}}</td>
                                            <td>{{$fulltt->batch}}</td>
                                            <td>{{$fulltt->type}}</td>
                                            <td>{{$fulltt->subject}}</td>
                                            <td>{{$fulltt->faculty}}</td>
                                            <td><button class="btn btn-success" data-ttid="{{$fulltt->id}}" data-ttid="{{$fulltt->id}}" data-ttday="{{$fulltt->day}}" data-tttime="{{$fulltt->time}}" data-ttdepartment="{{$fulltt->department}}" data-ttbatch="{{$fulltt->batch}}" data-tttype="{{$fulltt->type}}" data-ttsubject="{{$fulltt->subject}}" data-ttfaculty="{{$fulltt->faculty}}" data-toggle="modal" data-target="#edit">Update</button> 
                                                <button type="submit" class="btn btn-danger" data-ttid="{{$fulltt->id}}" data-toggle="modal" data-target="#delete">Delete</button>
                                          </td>
                                          </tr>
                                        @endif
                                      @endforeach
                                    </tbody>
                                </table>
                              </div>
                            </div>
                            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                              <a class="card-title"> <h4>Information Technolgy SY</h4> </a>
                            </div>
                            <div id="collapseFour" class="collapse" data-parent="#accordion">
                              <div class="card-body">
                                <table class="table" id="IT-SY">
                                    <thead class="text-primary">
                                      <th>
                                        Day
                                      </th>
                                      <th>
                                        Time
                                      </th>
                                      <th>
                                        Department
                                      </th>
                                      <th>
                                        Batch
                                      </th>
                                      <th>
                                        Type
                                      </th>
                                      <th>
                                        Subject
                                      </th>
                                      <th>
                                        Faculty
                                      </th>
                                      <th>
                                        Action
                                      </th>
                                    </thead>
                                  <tbody>
                                      @foreach($fulltts as $fulltt)
                                        @if($fulltt->department == "Information Technology" &&  $fulltt->batch == "Second Year")
                                          <tr>
                                            <td>{{$fulltt->day}}</td>
                                            <td>{{$fulltt->time}}</td>
                                            <td>{{$fulltt->department}}</td>
                                            <td>{{$fulltt->batch}}</td>
                                            <td>{{$fulltt->type}}</td>
                                            <td>{{$fulltt->subject}}</td>
                                            <td>{{$fulltt->faculty}}</td>
                                            <td><button class="btn btn-success" data-ttid="{{$fulltt->id}}" data-ttid="{{$fulltt->id}}" data-ttday="{{$fulltt->day}}" data-tttime="{{$fulltt->time}}" data-ttdepartment="{{$fulltt->department}}" data-ttbatch="{{$fulltt->batch}}" data-tttype="{{$fulltt->type}}" data-ttsubject="{{$fulltt->subject}}" data-ttfaculty="{{$fulltt->faculty}}" data-toggle="modal" data-target="#edit">Update</button> 
                                                <button type="submit" class="btn btn-danger" data-ttid="{{$fulltt->id}}" data-toggle="modal" data-target="#delete">Delete</button>
                                          </td>
                                          </tr>
                                        @endif
                                      @endforeach
                                    </tbody>
                                </table>
                              </div>
                            </div>
                            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                              <a class="card-title"> <h4>Computer Science FY</h4> </a>
                            </div>
                            <div id="collapseFive" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                  <table class="table" id="CS-FY">
                                      <thead class="text-primary">
                                        <th>
                                          Day
                                        </th>
                                        <th>
                                          Time
                                        </th>
                                        <th>
                                          Department
                                        </th>
                                        <th>
                                          Batch
                                        </th>
                                        <th>
                                          Type
                                        </th>
                                        <th>
                                          Subject
                                        </th>
                                        <th>
                                          Faculty
                                        </th>
                                        <th>
                                          Action
                                        </th>
                                      </thead>
                                    <tbody>
                                        @foreach($fulltts as $fulltt)
                                          @if($fulltt->department == "Computer Science" &&  $fulltt->batch == "First Year")
                                            <tr>
                                              <td>{{$fulltt->day}}</td>
                                              <td>{{$fulltt->time}}</td>
                                              <td>{{$fulltt->department}}</td>
                                              <td>{{$fulltt->batch}}</td>
                                              <td>{{$fulltt->type}}</td>
                                              <td>{{$fulltt->subject}}</td>
                                              <td>{{$fulltt->faculty}}</td>
                                              <td><button class="btn btn-success" data-ttid="{{$fulltt->id}}" data-ttid="{{$fulltt->id}}" data-ttday="{{$fulltt->day}}" data-tttime="{{$fulltt->time}}" data-ttdepartment="{{$fulltt->department}}" data-ttbatch="{{$fulltt->batch}}" data-tttype="{{$fulltt->type}}" data-ttsubject="{{$fulltt->subject}}" data-ttfaculty="{{$fulltt->faculty}}" data-toggle="modal" data-target="#edit">Update</button> 
                                                  <button type="submit" class="btn btn-danger" data-ttid="{{$fulltt->id}}" data-toggle="modal" data-target="#delete">Delete</button>
                                            </td>
                                            </tr>
                                          @endif
                                        @endforeach
                                      </tbody>
                                  </table>
                                </div>
                            </div>
                            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
                              <a class="card-title"> <h4>Information Technology FY</h4> </a>
                            </div>
                            <div id="collapseSix" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                  <table class="table" id="IT-FY">
                                      <thead class="text-primary">
                                        <th>
                                          Day
                                        </th>
                                        <th>
                                          Time
                                        </th>
                                        <th>
                                          Department
                                        </th>
                                        <th>
                                          Batch
                                        </th>
                                        <th>
                                          Type
                                        </th>
                                        <th>
                                          Subject
                                        </th>
                                        <th>
                                          Faculty
                                        </th>
                                        <th>
                                          Action
                                        </th>
                                      </thead>
                                    <tbody>
                                        @foreach($fulltts as $fulltt)
                                          @if($fulltt->department == "Information Technology" &&  $fulltt->batch == "First Year")
                                            <tr>
                                              <td>{{$fulltt->day}}</td>
                                              <td>{{$fulltt->time}}</td>
                                              <td>{{$fulltt->department}}</td>
                                              <td>{{$fulltt->batch}}</td>
                                              <td>{{$fulltt->type}}</td>
                                              <td>{{$fulltt->subject}}</td>
                                              <td>{{$fulltt->faculty}}</td>
                                              <td><button class="btn btn-success" data-ttid="{{$fulltt->id}}" data-ttid="{{$fulltt->id}}" data-ttday="{{$fulltt->day}}" data-tttime="{{$fulltt->time}}" data-ttdepartment="{{$fulltt->department}}" data-ttbatch="{{$fulltt->batch}}" data-tttype="{{$fulltt->type}}" data-ttsubject="{{$fulltt->subject}}" data-ttfaculty="{{$fulltt->faculty}}" data-toggle="modal" data-target="#edit">Update</button> 
                                                  <button type="submit" class="btn btn-danger" data-ttid="{{$fulltt->id}}" data-toggle="modal" data-target="#delete">Delete</button>
                                            </td>
                                            </tr>
                                          @endif
                                        @endforeach
                                      </tbody>
                                  </table>
                                </div>
                            </div>
                        </div>
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      
    
  <div class="modal fade table" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Edit Time Table</h4>
          <button type="button" class="close float-left" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          
        </div>
        <form action="#" id="editform" class="form" method="post">
            {{method_field('patch')}}
            @csrf
          <div class="modal-body">
            <input type="hidden" name="id" id="tt_id" value="">
            <table class="table">
              <thead class=" text-primary">
                <th>
                  Day
                </th>
                <th>
                  Time
                </th>
                </thead>
                <tbody>
                  <tr>
                    <td><input type="text" name="ttday" id="ttday" class="btn dropdown-toggle" readonly value="{{ __('Day...') }}" style="color: white; background-color: purple;border-color: purple;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required >
                      <div class="dropdown-menu" aria-labelledby="day" >
                        <a class="dropdown-item" onclick="document.getElementById('day').setAttribute('value','Monday');" >Monday</a>
                        <a class="dropdown-item" onclick="document.getElementById('day').setAttribute('value','Tuesday');" >Tuesday</a>
                        <a class="dropdown-item" onclick="document.getElementById('day').setAttribute('value','Wednesday');" >Wednesday</a>
                        <a class="dropdown-item" onclick="document.getElementById('day').setAttribute('value','Thursday');" >Thursday</a>
                        <a class="dropdown-item" onclick="document.getElementById('day').setAttribute('value','Friday');" >Friday</a>
                        <a class="dropdown-item" onclick="document.getElementById('day').setAttribute('value','Saturdayday');" >Saturday</a>
                      </div>
                    </td>
                    <td><input type="time" class="btn dropdown-toggle"  name="tttime" id="tttime" style="/* border-radius:3px; border-width:14px; border-style:solid; */ color: white; background-color: purple;border-color: purple;" >
                      
                    </td>
                  </tr>
                </tbody>
                <thead class=" text-primary">
                <th>
                  Department
                </th>
                <th>
                  Batch
                </th>
              </thead>
              <tbody>
                <tr>
                    <td><input class="btn dropdown-toggle" type="text" readonly name="ttdepartment" id="ttdepartment" style="color: white; background-color: purple;border-color: purple;" value="Department..." data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required>
                      <div class="dropdown-menu" aria-labelledby="ttdepartment">
                        <a class="dropdown-item"  onclick="document.getElementById('ttdepartment').setAttribute('value','Computer Science');" >Computer Science</a>
                        <a class="dropdown-item" onclick="document.getElementById('ttdepartment').setAttribute('value','Information Technology');" >Information Technology</a>
                      </div></td>
                    <td><input class="btn dropdown-toggle" type="text" readonly name="ttbatch" id="ttbatch" value="{{ __('Batch...') }}" style="color: white; background-color: purple;border-color: purple;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required  >
                      <div class="dropdown-menu" aria-labelledby="ttbatch">
                        <a class="dropdown-item" onclick="document.getElementById('ttbatch').setAttribute('value','First Year');" >First Year</a>
                        <a class="dropdown-item" onclick="document.getElementById('ttbatch').setAttribute('value','Second Year');" >Second Year</a>
                        <a class="dropdown-item" onclick="document.getElementById('ttbatch').setAttribute('value','Third Year');">Third Year</a>
                      </div>
                    </td>
                </tr>  
                  
              </tbody>  

                <tbody> 
                  
                  <thead class=" text-primary">
                    <th>
                      Type
                    </th>
                    <th>
                      Subject
                    </th>
                    </thead>
                    <tbody>
                      <td><input type="text" name='tttype' id='tttype' class="btn dropdown-toggle" readonly value="{{ __('Type...') }}" style="color: white; background-color: purple;border-color: purple;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required >
                        <div class="dropdown-menu" aria-labelledby="tttype" >
                          <a class="dropdown-item" onclick="document.getElementById('tttype').setAttribute('value','Lecture');" >Lecture</a>
                          <a class="dropdown-item" onclick="document.getElementById('tttype').setAttribute('value','Practical');" >Practical</a>
                        </div>
                      </td>
                      <td><input type="text" name='ttsubject' id="ttsubject" placeholder="Subject" class="btn dropdown-toggle" style="color: white; background-color: purple;border-color: purple;" ></td>
                    </tbody>
                    <thead class=" text-primary">
                      <th>
                        Faculty
                      </th>
                      <th>
                        Action
                      </th>
                    </thead>
                    <tbody>
                      <tr>
                        <td><input type="text" name='ttfaculty' id="ttfaculty" placeholder="Faculty" class="btn dropdown-toggle" style=" color: white; background-color: purple;border-color: purple;"  ></td>
                        <td>
                        <button type="submit" class="btn btn-primary">Save Changes</button></td>
                      </tr>
                    </tbody>
                
                  
            </table>
          </div>
          
        </form>
      </div>
    </div>
  </div>
  <div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form action="#" id="delform" method="post">
            {{method_field('delete')}}
            @csrf
          <div class="modal-body">
          <p class="text-center">
            Are you sure you want to delete this?
          </p>
              <input type="hidden" name="ttid" id="ttid"  value="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
            <button type="submit" class="btn btn-warning">Yes, Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  @endif

</div>

@endsection