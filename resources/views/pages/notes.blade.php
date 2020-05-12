@extends('layouts.app', ['activePage' => 'notes', 'titlePage' => __('Notes')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header card-header-primary">
        <h3 class="card-title">Notes</h3>
        <p class="card-category">Get your notes here or post your own notes.</p>
      </div>
      <br>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header card-header-info">
                <h4 class="card-title">@if(Auth::user()->user_type == "faculty") Teachers Notes <button class="btn btn-danger">Add new </button> @endif @if(Auth::user()->user_type == "student") Teachers Notes @endif </h4>
              </div>
              <div class="card-body">
                <div class="alert alert-success">
                  <span>This is a plain notification</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header card-header-info">
                <h4 class="card-title">@if(Auth::user()->user_type == "faculty") Student Notes  @endif @if(Auth::user()->user_type == "student") Personal Notes <button class="btn btn-danger">Add new </button> @endif </h4>
              </div>
              <div class="card-body">
                <div class="alert alert-success">
                  <span>This is a plain notification</span>
                </div>
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
@endsection
