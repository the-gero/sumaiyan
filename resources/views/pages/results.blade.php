@extends('layouts.app', ['activePage' => 'results', 'titlePage' => __('Results')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title">Results Corner</h4>
        <p class="card-category">Here you can find all your results of your exams</p>
      </div>
      <div class="card-body">
        <div id="typography">
          <h2>Results</h2>
          @if(Auth::user()->user_type == "faculty")
            <form method="post" action="{{ route('results.store') }}" autocomplete="off" class="form-horizontal">
              @csrf
              @method('post')

              <div class="card ">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">{{ __('Add Result') }}</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body ">
                  <div class="row bmd-form-group{{ $errors->has('department') ? ' has-danger' : '' }} mt-3">
                    <div class="input-group ">
                      <div class="input-group-prepend col-sm-2 col-form-label">
                        <span class="input-group-text ">
                          <i class="material-icons">account_balance</i>
                        </span>
                      </div>
                        <input class="btn dropdown-toggle" type="text" readonly name="department" id="department" value="{{ __('Department...') }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required>
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
                      <div class="input-group-prepend col-sm-2 col-form-label">
                        <span class="input-group-text">
                          <i class="material-icons">class</i>
                        </span>
                      </div>
                        <input class="btn dropdown-toggle" type="text" readonly name="batch" id="batch" value="{{ __('Batch...') }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required  >
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
                      <div class="input-group-prepend col-sm-2 col-form-label">
                        <span class="input-group-text">
                          <i class="material-icons">timelapse</i>
                        </span>
                      </div>
                        <input class="btn dropdown-toggle" type="text" readonly name="sem" id="sem" value="{{ __('Sem...') }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required  >
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
                  <div class="row bmd-form-group{{ $errors->has('type') ? ' has-danger' : '' }} mt-3">
                    <div class="input-group">
                      <div class="input-group-prepend col-sm-2 col-form-label">
                        <span class="input-group-text">
                          <i class="material-icons">class</i>
                        </span>
                      </div>
                        <input class="btn dropdown-toggle" type="text" readonly name="type" id="type" value="{{ __('Type...') }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required  >
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
                  <div class="card-footer ml-auto mr-auto justify-content-center">
                    <button type="submit" class="btn btn-primary ">{{ __('Add Result') }}</button>
                  </div>
              </div>
            </form>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

@endsection