@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Time Table')])

@section('content')
<div class="content">
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
                  <form action="{{ route('time-table.store') }}" method="post" enctype="multipart/form-data" class="form">
                    @csrf
                    <tr>
                      <td><input type="text" name="day" placeholder="Day" ></td>
                      <td><input type="time" name="time" id="time" ></td>
                      <td><input class="btn dropdown-toggle" type="text" readonly name="department" id="department" value="{{ __('Department...') }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required>
                        <div class="dropdown-menu" aria-labelledby="department">
                          <a class="dropdown-item" onclick="document.getElementById('department').setAttribute('value','Computer Science');" >Computer Science</a>
                          <a class="dropdown-item" onclick="document.getElementById('department').setAttribute('value','Information Technology');" >Information Technology</a>
                        </div></td>
                      <td><input class="btn dropdown-toggle" type="text" readonly name="batch" id="batch" value="{{ __('Batch...') }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required  >
                        <div class="dropdown-menu" aria-labelledby="batch">
                          <a class="dropdown-item" onclick="document.getElementById('batch').setAttribute('value','First Year');" >First Year</a>
                          <a class="dropdown-item" onclick="document.getElementById('batch').setAttribute('value','Second Year');" >Second Year</a>
                          <a class="dropdown-item" onclick="document.getElementById('batch').setAttribute('value','Third Year');">Third Year</a>
                        </div></td>
                      <td><input type="text" name='type' placeholder="Type" ></td>
                      <td><input type="text" name='subject' placeholder="Subject" ></td>
                      <td><input type="text" name='faculty' placeholder="Faculty" ></td>
                      <td><input type="submit" value="Submit"> <button type="submit"><span class="input-group-text"><i class="material-icons">add</i></span></button> </td>
                    </tr>
                  </form>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif
</div>
@endsection