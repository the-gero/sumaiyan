@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

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
        @if (session('error'))
          <div class="row">
            <div class="col-sm-12">
              <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <i class="material-icons">close</i>
                </button>
                <span>{{ session('error') }}</span>
              </div>
            </div>
          </div>
        @endif
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">content_copy</i>
              </div>
              <p class="card-category">Used Space</p>
              <h3 class="card-title">0.49 of 1
                GB
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-danger">warning</i>
                <a href="#pablo">Get More Space...</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">store</i>
              </div>
              <p class="card-category">Homeworks</p>
              <h3 class="card-title">3 Remaining</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">date_range</i> Last 24 Hours
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">info_outline</i>
              </div>
              <p class="card-category">Undone Tasks</p>
              <h3 class="card-title">7 Remaining</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">local_offer</i>Your Personal tasks
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="fa fa-users"></i>
              </div>
              <p class="card-category">Defaulters</p>
              <h3 class="card-title">+245 Undone Tasks</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">update</i> Just Updated
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="row">
        <div @if(Auth::user()->user_type == "faculty") class="col-lg-6 col-md-12" @else class="col-lg-12 col-md-12" @endif >
          <div class="card">
            <div class="card-header card-header-tabs card-header-primary">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <ul class="nav nav-tabs" data-tabs="tabs">
                    <li class="nav-item">
                      <a class="nav-link active" href="#homework" data-toggle="tab">
                        <i class="material-icons">home_work</i> Home Work
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#notice" data-toggle="tab">
                        <i class="material-icons">new_releases</i> Notice
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#tasks" data-toggle="tab">
                        <i class="material-icons">done</i> MyTasks
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    @if(Auth::user()->user_type == "faculty")
                      <li class="nav-item">
                        <a data-toggle="modal" data-target="#new" class="nav-link">
                          <i class="material-icons">add</i> Add
                        </a>
                      </li>
                    @endif
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="homework">
                  <table class="table">
                    <tbody>
                      @if(count($tasknotes)>0)
                        @foreach ($tasknotes as $tasknote)
                          @if($tasknote->type = "HomeWork")
                            <tr class="card-header card-header-info">
                              <td class="text-center">
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="" checked>
                                    <span class="form-check-sign">
                                      <span class="check"></span>
                                    </span>
                                  </label>
                                </div>
                              </td>
                              <td class="text-center">
                                {{$tasknote->subject}}
                              </td>
                              <td class="text-center">{{$tasknote->description}}</td>
                              @if(Auth::user()->user_type == "faculty")
                                <td class="td-actions justify-content-center">
                                    <button type="button" rel="tooltip" title="Edit Homework" class="btn btn-primary btn-link btn-sm " data-toggle="modal" data-target= "#newedit">
                                      <i class="material-icons">edit</i>
                                    </button>
                                    <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                      <i class="material-icons">close</i>
                                    </button>
                                </td>
                              @endif 
                            </tr>
                          @endif
                        @endforeach
                      @else
                          <tr>
                            <td>
                              Yay no Homeworks!
                            </td>
                          </tr>
                      @endif
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane" id="notice">
                  <table class="table">
                    <tbody>
                      @if(count($tasknotes)>0)
                        @foreach ($tasknotes as $tasknote)
                          @php
                              $flag = 0 ;
                          @endphp
                          @if($tasknote->type == "Notice")
                            @php
                              $flag = 1 ;
                            @endphp
                            <tr class="card-header card-header-warning">
                              <td class="text-center">
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="" checked>
                                    <span class="form-check-sign">
                                      <span class="check"></span>
                                    </span>
                                  </label>
                                </div>
                              </td>
                              <td class="text-left">{{$tasknote->description}}
                              </td>
                              @if(Auth::user()->user_type == "faculty")
                                <td class="td-actions justify-content-center">
                                  <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm" data-toggle="modal" data-target="#newedit">
                                    <i class="material-icons">edit</i>
                                  </button>
                                  <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                    <i class="material-icons">close</i>
                                  </button>
                                </td>
                              @endif
                            </tr>
                          @endif
                        @endforeach
                      @endif
                      @if($flag == 0)
                        <tr>
                          <td>
                            No Notices yet.
                          </td>
                        </tr>
                      @endif
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane" id="tasks">
                  <table class="table">
                    @if(Auth::user()->user_type == "student")
                      <thead class="text-center">
                        <th colspan="4">
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#new">
                            Add new Task
                          </button>
                        </th>
                      </thead>
                    @endif
                    <tbody>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm" data-toggle="modal" data-target="#newedit">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        @if(Auth::user()->user_type == "faculty")
          <div class="col-lg-6 col-md-12">
            <div class="card">
              <div class="card-header card-header-warning">
                <h4 class="card-title">News</h4>
                <p class="card-category">See whats new in your campus.</p>
              </div>
              <div class="card-body table-responsive" >
                <table class="table">
                  <tbody>
                    <tr>
                      <td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                      <td class="td-actions text-right">
                        <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm" data-toggle="modal" data-target="#newedit">
                          <i class="material-icons">edit</i>
                        </button>
                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                          <i class="material-icons">close</i>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>
  <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="newLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form method="POST" class="form" action="{{route('tasknote.store')}}" >
        <div class="card modal-content">
          <div class="card-header card-header-info">
            <h4 class="card-title" id="newLabel">
              Add New
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </h4>
            
          </div>
          <div class="card-body">
                  @csrf
                  {{-- <input type="hidden" name="uniqueid" id="uniqueid" value=""> --}}
                  @if(Auth::user()->user_type == "faculty")
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
                  @endif
                  <div class="row bmd-form-group{{ $errors->has('description') ? ' has-danger' : '' }} mt-3">
                    <div class="input-group">
                      <div class="input-group-prepend col-sm-3 col-form-label">
                        <span class="input-group-text">
                          <i class="material-icons">description</i>
                        </span>
                      </div>
                        <textarea class="btn text-left col-md-6" cols="100" rows="10" type="textarea"  name="description" id="description" placeholder="{{ __('Description...') }}"   {{-- data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" --}} required  ></textarea>
                    </div>
                    
                    @if ($errors->has('description'))
                      <div id="description-error" class="error text-danger pl-3 "  style="display: block;">
                      <strong>{{ $errors->first('description') }}</strong>
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
                        <input class="btn dropdown-toggle col-md-6" type="button" readonly name="typeshow" id="typeshow" value="{{ __('Type...') }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required  >
                        <div class="dropdown-menu" aria-labelledby="type">
                          @if(Auth::user()->user_type == "faculty")
                            <a class="dropdown-item" onclick="document.getElementById('type').setAttribute('value','HomeWork');document.getElementById('typeshow').setAttribute('value','HomeWork');" >HomeWork</a>
                            <a class="dropdown-item" onclick="document.getElementById('type').setAttribute('value','Notice');document.getElementById('typeshow').setAttribute('value','Notice');" >Notice</a>
                          @endif
                          <a class="dropdown-item" onclick="document.getElementById('type').setAttribute('value','Task');document.getElementById('typeshow').setAttribute('value','Task');" >Task</a>
                        </div>
                        <input type="text" name="type" id="type" hidden>
                    </div>
                    
                    @if ($errors->has('type'))
                      <div id="type-error" class="error text-danger pl-3" for="type" style="display: block;">
                      <strong>{{ $errors->first('type') }}</strong>
                      </div>
                    @endif
                  </div>
          </div>
          
          <div class="modal-footer justify-content-center">
              <button type="submit" class="btn btn-warning">Save changes</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="modal fade" id="newsta" tabindex="-1" role="dialog" aria-labelledby="newstaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newstaLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="newedit" tabindex="-1" role="dialog" aria-labelledby="neweditLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="neweditLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          NEdit
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="ndelete" tabindex="-1" role="dialog" aria-labelledby="ndeleteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ndeleteLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Delete
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush