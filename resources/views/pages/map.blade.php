@extends('layouts.app', ['activePage' => 'map', 'titlePage' => __('Map')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header card-header-primary">
          <h3 class="card-title">Maps</h3>
          <p class="card-category">
            Know what is where!
          </p>
        </div>
        <div class="card-body">
          <div class="row">

            <div class="card col-lg-6 col-md-12">
              <div class="card-header card-header-success">
                <h4 class="card-title">College Basic Map</h4>
                <small class="card-category">Here is a view
                </small>
              </div>
              <div class="card-body" style="overflow-x: auto">
                <img src="https://alumni.somaiya.edu/media/559/uploads/Somaiya_Vidyavihar_Future_Plans(1).jpg" alt="">
              </div>
            </div>
            
            <div class="card col-lg-6 col-md-12">
              <div class="card-header card-header-success">
                <h4 class="card-title">Google Map</h4>
                <small class="card-category">Here is a view
                </small>
              </div>
              <div class="card-body"  >
                {{-- <div id="googleMap" style="width:100%;height:50vh">
                </div> --}}
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3770.736857275218!2d72.89921704296565!3d19.075303839256094!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c627fec91b7d%3A0x5ec0a3af853f437d!2sK.%20J.%20Somaiya%20College%20Of%20Science%20And%20Commerce!5e0!3m2!1sen!2sin!4v1589374308774!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
     


@endsection

@push('js')
{{-- <script>
  $(document).ready(function() {
    // Javascript method's body can be found in assets/js/demos.js
    demo.initGoogleMaps();
  });
</script> --}}
<script>
  function myMap() {
  var mapProp= {
    center:new google.maps.LatLng(19.073531,72.899546),
    zoom:17,
  };
  var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
  }
  </script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9VgvfLlF4kVNzCC6HcumpnpeZsALS5JY&callback=myMap"></script>
@endpush