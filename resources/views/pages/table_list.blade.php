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
          <div class="card-body">
            <div class="table-responsive">
              @if(count($fulltts)>0)
                <table class="table" id="CS-TY">
                  <tbody>
                    <thead >
                      <th class="text-center" colspan="8"> <h3>Computer Science TY</h3> </th>
                    </thead>
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
                            <td>Update, <form method="post" action="{{route('time-table.destroy', $fulltt->id)}}"> 
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                              </form> 
                          </td>
                          </tr>
                        @endif
                      @endforeach
                    </tbody>
                </table>
                <table class="table" id="IT-TY">
                  <tbody>
                    <thead >
                      <th class="text-center" colspan="8"> <h3>Information Technology TY</h3> </th>
                    </thead>
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
                            <td>Update, <form method="post" action="{{route('time-table.destroy', $fulltt->id)}}"> 
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                              </form> 
                          </td>
                          </tr>
                        @endif
                      @endforeach
                    </tbody>
                </table>
                <table class="table" id="CS-SY">
                  <tbody>
                    <thead >
                      <th class="text-center" colspan="8"> <h3>Computer Science SY</h3> </th>
                    </thead>
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
                            <td>Update, <form method="post" action="{{route('time-table.destroy', $fulltt->id)}}"> 
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                              </form> 
                          </td>
                          </tr>
                        @endif
                      @endforeach
                    </tbody>
                </table>
                <table class="table" id="IT-SY">
                  <tbody>
                    <thead >
                      <th class="text-center" colspan="8"> <h3>Information Technolgy SY</h3> </th>
                    </thead>
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
                            <td>Update, <form method="post" action="{{route('time-table.destroy', $fulltt->id)}}"> 
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                              </form> 
                          </td>
                          </tr>
                        @endif
                      @endforeach
                    </tbody>
                </table>
                <table class="table" id="CS-FY">
                  <tbody>
                    <thead >
                      <th class="text-center" colspan="8"> <h3>Computer Science FY</h3> </th>
                    </thead>
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
                            <td>Update, <form method="post" action="{{route('time-table.destroy', $fulltt->id)}}"> 
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                              </form> 
                          </td>
                          </tr>
                        @endif
                      @endforeach
                    </tbody>
                </table>
                <table class="table" id="IT-FY">
                  <tbody>
                    <thead >
                      <th class="text-center" colspan="8"> <h3>Information Technology FY</h3> </th>
                    </thead>
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
                            <td>Update, <form method="post" action="{{route('time-table.destroy', $fulltt->id)}}"> 
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                              </form> 
                          </td>
                          </tr>
                        @endif
                      @endforeach
                    </tbody>
                </table>
              @endif
                
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @endif

  
</div>
@endsection