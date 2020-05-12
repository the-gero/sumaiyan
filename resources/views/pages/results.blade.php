@extends('layouts.app', ['activePage' => 'results', 'titlePage' => __('Results')])

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
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title">Results Corner</h4>
        <p class="card-category">@if(Auth::user()->user_type == "faculty") Manage Results @endif @if(Auth::user()->user_type == "student") Here you can find all your results of your exams @endif </p>
      </div>
      <div class="card-body">
        <div id="typography">
          <h2>Results</h2>
          @if(Auth::user()->user_type == "faculty")
            <form method="post" action="{{ route('results.store') }}" enctype="multipart/form-data" autocomplete="off" class="form-horizontal">
              @csrf
              @method('post')

              <div class="card ">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">{{ __('Add Result') }}</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body ">
                  <div class="row  bmd-form-group{{ $errors->has('department') ? ' has-danger' : '' }} mt-3">
                    <div class="input-group justify-content-center">
                      <div class="input-group-prepend col-sm-2 col-form-label">
                        <span class="input-group-text ">
                          <i class="material-icons">account_balance</i>
                        </span>
                      </div>
                        <input class="btn dropdown-toggle col-md-3" type="text" readonly name="department" id="department" value="{{ __('Department...') }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required>
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
                    <div class="input-group justify-content-center">
                      <div class="input-group-prepend col-sm-2 col-form-label">
                        <span class="input-group-text">
                          <i class="material-icons">class</i>
                        </span>
                      </div>
                        <input class="btn dropdown-toggle col-md-3" type="text" readonly name="batch" id="batch" value="{{ __('Batch...') }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required  >
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
                    <div class="input-group justify-content-center">
                      <div class="input-group-prepend col-sm-2 col-form-label">
                        <span class="input-group-text">
                          <i class="material-icons">timelapse</i>
                        </span>
                      </div>
                        <input class="btn dropdown-toggle col-md-3 " type="text" readonly name="sem" id="sem" value="{{ __('Sem...') }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required  >
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
                  <div class="row bmd-form-group{{ $errors->has('monthyear') ? ' has-danger' : '' }} mt-3">
                    <div class="input-group justify-content-center">
                      <div class="input-group-prepend col-sm-2 col-form-label">
                        <span class="input-group-text">
                          <i class="material-icons">calendar_today</i>
                        </span>
                      </div>
                        <input class="btn col-md-3 from" for="monthyear" onclick="(this).setAttribute('type','month');" type="text"  name="monthyear" id="monthyear" value="{{ __('Month and Year...') }}"   {{-- data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" --}} required  >
                    </div>
                    
                    @if ($errors->has('monthyear'))
                      <div id="monthyear-error" class="error text-danger pl-3 " for="monthyear" style="display: block;">
                      <strong>{{ $errors->first('monthyear') }}</strong>
                      </div>
                    @endif
                  </div>
                  <div class="row bmd-form-group{{ $errors->has('type') ? ' has-danger' : '' }} mt-3">
                    <div class="input-group justify-content-center">
                      <div class="input-group-prepend col-sm-2 col-form-label">
                        <span class="input-group-text">
                          <i class="material-icons">class</i>
                        </span>
                      </div>
                        <input class="btn dropdown-toggle col-md-3" type="text" readonly name="type" id="type" value="{{ __('Type...') }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required  >
                        <div class="dropdown-menu" aria-labelledby="type">
                          <a class="dropdown-item" onclick="document.getElementById('type').setAttribute('value','Regular');" >Regular</a>
                          <a class="dropdown-item" onclick="document.getElementById('type').setAttribute('value','AT/KT');" >AT/KT</a>
                        </div>
                    </div>
                    
                    @if ($errors->has('type'))
                      <div id="type-error" class="error text-danger pl-3" for="type" style="display: block;">
                      <strong>{{ $errors->first('type') }}</strong>
                      </div>
                    @endif
                  </div>
                  <div class="row bmd-form-group{{ $errors->has('file') ? ' has-danger' : '' }} mt-3">
                    <div class="input-group justify-content-center">
                      <div class="input-group-prepend col-sm-2 col-form-label">
                        <span class="input-group-text">
                          <i class="material-icons">attach_file</i>
                        </span>
                      </div>
                        <input class="btn col-md-3" accept=".pdf" for="file"  type="file"  name="file" id="file" value="{{ __('Upload File...') }}"   {{-- data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" --}} required  >
                    </div>
                    
                    @if ($errors->has('file'))
                      <div id="file-error" class="error text-danger pl-3 " for="file" style="display: block;">
                      <strong>{{ $errors->first('file') }}</strong>
                      </div>
                    @endif
                  </div>
                  <div class="card-footer ml-auto mr-auto justify-content-center">
                    <button type="submit" class="btn btn-primary ">{{ __('Add Result') }}</button>
                  </div>
              
            </form>
          </div>
      </div>
            <div class="card">
              <div class="card-header card-header-success">
                <h4 class="card-title">Regular</h4>
                <p class="card-category">Regular Semesterwise results. </p>
              </div>
              <div class="card-body">
                <div id="accordion" class="accordion">
                  <div class="card mb-0">
                    <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                      <a class="card-title"> TYCS </a>
                    </div>
                    <div id="collapse1" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                        <table class="table">
                          <tbody>
                            @foreach($results as $result)
                              @if($result->department == "Computer Science" && $result->batch == "Third Year" && $result->type == "Regular")
                                <tr>
                                  <td class="text-primary">SEM : {{$result->sem}}</td>
                                  <td class="text-primary">Year / Month : {{$result->monthyear}}</td>
                                  <td><a class="btn btn-primary" onclick="document.getElementById('resultframe').setAttribute('src','/storage/results/{{$result->file}}'); " data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Show Result</a></td>
                                  <td><button type="submit" class="btn btn-danger" data-rid="{{$result->id}}" data-toggle="modal" data-target="#delete1">Delete</button></td>
                                  <td></td>
                                </tr>
                              @endif
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                      <a class="card-title"> TYIT </a>
                    </div>
                    <div id="collapse2" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                        <table class="table">
                          <tbody>
                            @foreach($results as $result)
                              @if($result->department == "Information Technology" && $result->batch == "Third Year")
                                <tr>
                                  <td class="text-primary">SEM : {{$result->sem}}</td>
                                  <td class="text-primary">Year / Month : {{$result->monthyear}}</td>
                                  <td><a class="btn btn-primary" onclick="document.getElementById('resultframe').setAttribute('src','/storage/results/{{$result->file}}'); " data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Show Result</a></td>
                                  <td><button type="submit" class="btn btn-danger" data-rid="{{$result->id}}" data-toggle="modal" data-target="#delete1">Delete</button></td>
                                </tr>
                              @endif
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                      <a class="card-title"> SYCS </a>
                    </div>
                    <div id="collapse3" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                        <table class="table">
                          <tbody>
                            @foreach($results as $result)
                              @if($result->department == "Computer Science" && $result->batch == "Second Year")
                                <tr>
                                  <td class="text-primary">SEM : {{$result->sem}}</td>
                                  <td class="text-primary">Year / Month : {{$result->monthyear}}</td>
                                  <td><a class="btn btn-primary" onclick="document.getElementById('resultframe').setAttribute('src','/storage/results/{{$result->file}}'); " data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Show Result</a></td>
                                  <td><button type="submit" class="btn btn-danger" data-rid="{{$result->id}}" data-toggle="modal" data-target="#delete1">Delete</button></td>
                                </tr>
                              @endif
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                      <a class="card-title"> SYIT </a>
                    </div>
                    <div id="collapse4" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                        <table class="table">
                          <tbody>
                            @foreach($results as $result)
                              @if($result->department == "Information Technology" && $result->batch == "Second Year")
                                <tr>
                                  <td class="text-primary">SEM : {{$result->sem}}</td>
                                  <td class="text-primary">Year / Month : {{$result->monthyear}}</td>
                                  <td><a class="btn btn-primary" onclick="document.getElementById('resultframe').setAttribute('src','/storage/results/{{$result->file}}'); " data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Show Result</a></td>
                                  <td><button type="submit" class="btn btn-danger" data-rid="{{$result->id}}" data-toggle="modal" data-target="#delete1">Delete</button></td>
                                </tr>
                              @endif
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                      <a class="card-title"> FYCS </a>
                    </div>
                    <div id="collapse5" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                        <table class="table">
                          <tbody>
                            @foreach($results as $result)
                              @if($result->department == "Computer Science" && $result->batch == "First Year")
                                <tr>
                                  <td class="text-primary">SEM : {{$result->sem}}</td>
                                  <td class="text-primary">Year / Month : {{$result->monthyear}}</td>
                                  <td><a class="btn btn-primary" onclick="document.getElementById('resultframe').setAttribute('src','/storage/results/{{$result->file}}'); " data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Show Result</a></td>
                                  <td><button type="submit" class="btn btn-danger" data-rid="{{$result->id}}" data-toggle="modal" data-target="#delete1">Delete</button></td>
                                </tr>
                              @endif
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse6">
                      <a class="card-title"> FYIT </a>
                    </div>
                    <div id="collapse6" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                        <table class="table">
                          <tbody>
                            @foreach($results as $result)
                              @if($result->department == "Information Technology" && $result->batch == "First Year")
                                <tr>
                                  <td class="text-primary">SEM : {{$result->sem}}</td>
                                  <td class="text-primary">Year / Month : {{$result->monthyear}}</td>
                                  <td><a class="btn btn-primary" onclick="document.getElementById('resultframe').setAttribute('src','/storage/results/{{$result->file}}'); " data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Show Result</a></td>
                                  <td><button type="submit" class="btn btn-danger" data-rid="{{$result->id}}" data-toggle="modal" data-target="#delete1">Delete</button></td>
                                </tr>
                              @endif
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="collapse" id="multiCollapseExample1">
                      <div class="card card-body">
                        <iframe src="#" id="resultframe" class="card-body" style="height:40vh" >Result</iframe>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endif
        </div>
        @if(Auth::user()->user_type == "faculty")
          <div class="card">
            <div id="typography1">
              <div class="card-header card-header-danger">
                <h4 class="card-title">AT/KT</h4>
                <p class="card-category">AT/KT Semesterwise results. </p>
              </div>
              <div class="card-body">
                <div id="accordion1" class="accordion">
                  <div class="card mb-0">
                    <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse12">
                      <a class="card-title"> TYCS </a>
                    </div>
                    <div id="collapse12" class="collapse" data-parent="#accordion1">
                      <div class="card-body">
                        <table class="table">
                          <tbody>
                            @foreach($results as $result)
                              @if($result->department == "Computer Science" && $result->batch == "Third Year" && $result->type == "AT/KT")
                                <tr>
                                  <td class="text-primary">SEM : {{$result->sem}}</td>
                                  <td class="text-primary">Year / Month : {{$result->monthyear}}</td>
                                  <td><a class="btn btn-primary" onclick="document.getElementById('resultframe1').setAttribute('src','/storage/results/{{$result->file}}'); " data-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample2">Show Result</a></td>
                                  <td><button type="submit" class="btn btn-danger" data-rid="{{$result->id}}" data-toggle="modal" data-target="#delete1">Delete</button></td>
                                </tr>
                              @endif
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse21">
                      <a class="card-title"> TYIT </a>
                    </div>
                    <div id="collapse21" class="collapse" data-parent="#accordion1">
                      <div class="card-body">
                        <table class="table">
                          <tbody>
                            @foreach($results as $result)
                              @if($result->department == "Information Technology" && $result->batch == "Third Year")
                                <tr>
                                  <td class="text-primary">SEM : {{$result->sem}}</td>
                                  <td class="text-primary">Year / Month : {{$result->monthyear}}</td>
                                  <td><a class="btn btn-primary" onclick="document.getElementById('resultframe1').setAttribute('src','/storage/results/{{$result->file}}'); " data-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample2">Show Result</a></td>
                                  <td><button type="submit" class="btn btn-danger" data-rid="{{$result->id}}" data-toggle="modal" data-target="#delete1">Delete</button></td>
                                </tr>
                              @endif
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse31">
                      <a class="card-title"> SYCS </a>
                    </div>
                    <div id="collapse31" class="collapse" data-parent="#accordion1">
                      <div class="card-body">
                        <table class="table">
                          <tbody>
                            @foreach($results as $result)
                              @if($result->department == "Computer Science" && $result->batch == "Second Year")
                                <tr>
                                  <td class="text-primary">SEM : {{$result->sem}}</td>
                                  <td class="text-primary">Year / Month : {{$result->monthyear}}</td>
                                  <td><a class="btn btn-primary" onclick="document.getElementById('resultframe1').setAttribute('src','/storage/results/{{$result->file}}'); " data-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample2">Show Result</a></td>
                                  <td><button type="submit" class="btn btn-danger" data-rid="{{$result->id}}" data-toggle="modal" data-target="#delete1">Delete</button></td>
                                </tr>
                              @endif
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse41">
                      <a class="card-title"> SYIT </a>
                    </div>
                    <div id="collapse41" class="collapse" data-parent="#accordion1">
                      <div class="card-body">
                        <table class="table">
                          <tbody>
                            @foreach($results as $result)
                              @if($result->department == "Information Technology" && $result->batch == "Second Year")
                                <tr>
                                  <td class="text-primary">SEM : {{$result->sem}}</td>
                                  <td class="text-primary">Year / Month : {{$result->monthyear}}</td>
                                  <td><a class="btn btn-primary" onclick="document.getElementById('resultframe1').setAttribute('src','/storage/results/{{$result->file}}'); " data-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample2">Show Result</a></td>
                                  <td><button type="submit" class="btn btn-danger" data-rid="{{$result->id}}" data-toggle="modal" data-target="#delete1">Delete</button></td>
                                </tr>
                              @endif
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse51">
                      <a class="card-title"> FYCS </a>
                    </div>
                    <div id="collapse51" class="collapse" data-parent="#accordion1">
                      <div class="card-body">
                        <table class="table">
                          <tbody>
                            @foreach($results as $result)
                              @if($result->department == "Computer Science" && $result->batch == "First Year")
                                <tr>
                                  <td class="text-primary">SEM : {{$result->sem}}</td>
                                  <td class="text-primary">Year / Month : {{$result->monthyear}}</td>
                                  <td><a class="btn btn-primary" onclick="document.getElementById('resultframe1').setAttribute('src','/storage/results/{{$result->file}}'); " data-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample2">Show Result</a></td>
                                  <td><button type="submit" class="btn btn-danger" data-rid="{{$result->id}}" data-toggle="modal" data-target="#delete1">Delete</button></td>
                                </tr>
                              @endif
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse61">
                      <a class="card-title"> FYIT </a>
                    </div>
                    <div id="collapse61" class="collapse" data-parent="#accordion1">
                      <div class="card-body">
                        <table class="table">
                          <tbody>
                            @foreach($results as $result)
                              @if($result->department == "Information Technology" && $result->batch == "First Year")
                                <tr>
                                  <td class="text-primary">SEM : {{$result->sem}}</td>
                                  <td class="text-primary">Year / Month : {{$result->monthyear}}</td>
                                  <td><a class="btn btn-primary" onclick="document.getElementById('resultframe1').setAttribute('src','/storage/results/{{$result->file}}'); " data-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample2">Show Result</a></td>
                                  <td><button type="submit" class="btn btn-danger" data-rid="{{$result->id}}" data-toggle="modal" data-target="#delete1">Delete</button></td>
                                </tr>
                              @endif
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="collapse" id="multiCollapseExample2">
                      <div class="card card-body">
                        <iframe src="#" id="resultframe1" class="card-body" style="height:40vh" >Result</iframe>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
          
        @endif
        <div id="typography4">
          @if(Auth::user()->user_type == "student")
                <div class="card">
                  <div class="card-header card-header-success">
                    <h4 class="card-title">Regular</h4>
                    <p class="card-category">Regular Semesterwise results. </p>
                  </div>
                  <div class="card-body">
                    <p>
                      <table class="table">
                        <tbody>
                          @foreach($results as $result)
                            @if($result->department == Auth::user()->department && $result->batch == Auth::user()->batch && $result->type == "Regular" )
                              <tr>
                                <td class="text-primary">SEM : {{$result->sem}}</td>
                                <td class="text-primary">Year / Month : {{$result->monthyear}}</td>
                                <td><a class="btn btn-primary" onclick="document.getElementById('resultframe').setAttribute('src','/storage/results/{{$result->file}}'); " data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Show Result</a></td>
                                <td><button type="submit" class="btn btn-danger" data-rid="{{$result->id}}" data-toggle="modal" data-target="#delete1">Delete</button></td>
                              </tr>
                            @endif
                          @endforeach
                        </tbody>
                      </table>
                    </p>
                    <div class="row">
                      <div class="col">
                        <div class="collapse" id="multiCollapseExample1">
                          <div class="card card-body">
                            <iframe src="#" id="resultframe" class="card-body" style="height:40vh" >Result</iframe>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-header card-header-danger">
                    <h4 class="card-title">AT/KT</h4>
                    <p class="card-category">AT/KT Semesterwise results. </p>
                  </div>
                  <div class="card-body">
                    <p>
                      <table class="table">
                        <tbody>
                          @foreach($results as $result)
                            @if($result->department == Auth::user()->department && $result->batch == Auth::user()->batch && $result->type == "AT/KT" )
                              <tr>
                                <td class="text-primary">SEM : {{$result->sem}}</td>
                                <td class="text-primary">Year / Month : {{$result->monthyear}}</td>
                                <td><a class="btn btn-primary" onclick="document.getElementById('resultframe1').setAttribute('src','/storage/results/{{$result->file}}'); " data-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample2">Show Result</a></td>
                                <td><button type="submit" class="btn btn-danger" data-rid="{{$result->id}}" data-toggle="modal" data-target="#delete1">Delete</button></td>
                              </tr>
                            @endif
                          @endforeach
                        </tbody>
                      </table>
                    </p>
                    <div class="row">
                      <div class="col">
                        <div class="collapse" id="multiCollapseExample2">
                          <div class="card card-body">
                            <iframe src="#" id="resultframe1" class="card-body" style="height:40vh" >Result</iframe>
                          </div>
                        </div>
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
<div class="modal modal-danger fade" id="delete1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form action="#" id="delformR" method="post">
          {{method_field('delete')}}
          @csrf
        <div class="modal-body">
        <p class="text-center">
          Are you sure you want to delete this result?
        </p>
            <input type="hidden" name="rid" id="rid"  value="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
          <button type="submit" class="btn btn-warning">Yes, Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
