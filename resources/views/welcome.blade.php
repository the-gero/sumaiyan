@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'titlePage' => __('Dashboard')])

@section('content')
<div class="container" style="height: auto;">
  <div class="row justify-content-center">
      <div class="col-lg-7 col-md-8">
          <h1 class="text-white text-center">{{ __('Welcome to Somaiyan.') }}</h1>
      </div>
  </div>
</div>
@endsection
