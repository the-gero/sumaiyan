@extends('layouts.app', ['activePage' => 'icons', 'titlePage' => __('Co-Curricular')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="container-fluid">
      <div class="card card-plain">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Co-Curricular</h4>
          <p class="card-category">At 
            <a target="_blank" href="https://kjssc.somaiya.edu/kjssc/Student/cultural">Somaiya Vidyavihar</a>
          </p>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card-body">
              <div class="iframe-container d-none d-lg-block">
                <iframe src="https://kjssc.somaiya.edu/kjssc/Student/cultural">
                  <p>Your browser does not support iframes.</p>
                </iframe>
              </div>
              <div class="col-md-12 d-none d-sm-block d-md-block d-lg-none d-block d-sm-none text-center ml-auto mr-auto">
                <h5> Check the
                  <a href="https://kjssc.somaiya.edu/kjssc/Student/cultural" target="_blank">Co Curricular section</a>
                </h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection