<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8" />
    <title>@if($titlePage == true) {{$titlePage}} @else {{$title}} @endif</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('material') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('material') }}/img/favicon.ico">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="{{ asset('material') }}/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('material') }}/demo/demo.css" rel="stylesheet" />
    </head>
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
    <body class="{{ $class ?? '' }}">
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @include('layouts.page_templates.auth')
        @endauth
        @guest()
            @include('layouts.page_templates.guest')
        @endguest
        
        {{-- <div class="fixed-plugin">
          <div class="dropdown show-dropdown">
            <a href="#" data-toggle="dropdown">
              <i class="fa fa-cog fa-2x"> </i>
            </a>
            <ul class="dropdown-menu">
              <li class="header-title"> Sidebar Filters</li>
              <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger active-color">
                  <div class="badge-colors ml-auto mr-auto">
                    <span class="badge filter badge-purple " data-color="purple"></span>
                    <span class="badge filter badge-azure" data-color="azure"></span>
                    <span class="badge filter badge-green" data-color="green"></span>
                    <span class="badge filter badge-warning active" data-color="orange"></span>
                    <span class="badge filter badge-danger" data-color="danger"></span>
                    <span class="badge filter badge-rose" data-color="rose"></span>
                  </div>
                  <div class="clearfix"></div>
                </a>
              </li>
              <li class="header-title">Images</li>
              <li class="active">
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                  <img src="{{ asset('material') }}/img/sidebar-1.jpg" alt="">
                </a>
              </li>
              <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                  <img src="{{ asset('material') }}/img/sidebar-2.jpg" alt="">
                </a>
              </li>
              <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                  <img src="{{ asset('material') }}/img/sidebar-3.jpg" alt="">
                </a>
              </li>
              <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                  <img src="{{ asset('material') }}/img/sidebar-4.jpg" alt="">
                </a>
              </li>
              <li class="button-container">
                <a href="#" target="_blank" class="btn btn-primary btn-block">Free Download</a>
              </li>
              <!-- <li class="header-title">Want more components?</li>
                  <li class="button-container">
                      <a href="https://www.creative-tim.com/product/material-dashboard-pro" target="_blank" class="btn btn-warning btn-block">
                        Get the pro version
                      </a>
                  </li> -->
              <li class="button-container">
                <a href="#" target="_blank" class="btn btn-default btn-block">
                  View Documentation
                </a>
              </li>
              <li class="button-container">
                <a href="#" target="_blank" class="btn btn-danger btn-block btn-round">
                  Upgrade to PRO
                </a>
              </li>
              <li class="button-container github-star">
                <a class="github-button" href="#" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star ntkme/github-buttons on GitHub">Star</a>
              </li>
              <li class="header-title">Thank you for 95 shares!</li>
              <li class="button-container text-center">
                <button id="twitter" class="btn btn-round btn-twitter"><i class="fa fa-twitter"></i> &middot; 45</button>
                <button id="facebook" class="btn btn-round btn-facebook"><i class="fa fa-facebook-f"></i> &middot; 50</button>
                <br>
                <br>
              </li>
            </ul>
          </div>
        </div> --}}
        <!--   Core JS Files   -->
        <script src="{{ asset('material') }}/js/core/jquery.min.js"></script>
        
        <script src="{{ asset('material') }}/js/core/popper.min.js"></script>
        <script src="{{ asset('material') }}/js/core/bootstrap-material-design.min.js"></script>
        <script src="{{ asset('material') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
        <!-- Plugin for the momentJs  -->
        <script src="{{ asset('material') }}/js/plugins/moment.min.js"></script>
        <!--  Plugin for Sweet Alert -->
        <script src="{{ asset('material') }}/js/plugins/sweetalert2.js"></script>
        <!-- Forms Validations Plugin -->
        <script src="{{ asset('material') }}/js/plugins/jquery.validate.min.js"></script>
        <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
        <script src="{{ asset('material') }}/js/plugins/jquery.bootstrap-wizard.js"></script>
        <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
        <script src="{{ asset('material') }}/js/plugins/bootstrap-selectpicker.js"></script>
        <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
        <script src="{{ asset('material') }}/js/plugins/bootstrap-datetimepicker.min.js"></script>
        <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
        <script src="{{ asset('material') }}/js/plugins/jquery.dataTables.min.js"></script>
        <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
        <script src="{{ asset('material') }}/js/plugins/bootstrap-tagsinput.js"></script>
        <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
        <script src="{{ asset('material') }}/js/plugins/jasny-bootstrap.min.js"></script>
        <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
        <script src="{{ asset('material') }}/js/plugins/fullcalendar.min.js"></script>
        <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
        <script src="{{ asset('material') }}/js/plugins/jquery-jvectormap.js"></script>
        <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
        <script src="{{ asset('material') }}/js/plugins/nouislider.min.js"></script>
        <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
        <!-- Library for adding dinamically elements -->
        <script src="{{ asset('material') }}/js/plugins/arrive.min.js"></script>
        <!--  Google Maps Plugin    -->
        {{-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9VgvfLlF4kVNzCC6HcumpnpeZsALS5JY&callback=initMap"></script> --}}
        <!-- Chartist JS -->
        <script src="{{ asset('material') }}/js/plugins/chartist.min.js"></script>
        <!--  Notifications Plugin    -->
        <script src="{{ asset('material') }}/js/plugins/bootstrap-notify.js"></script>
        <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="{{ asset('material') }}/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
        <!-- Material Dashboard DEMO methods, don't include it in your project! -->
        <script src="{{ asset('material') }}/demo/demo.js"></script>
        <script src="{{ asset('material') }}/js/settings.js"></script>
        <script>
          $('#edit').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) 
              var ttid = button.data('ttid') 
              var ttday = button.data('ttday') 
              var tttime = button.data('tttime') 
              var ttdepartment = button.data('ttdepartment') 
              var ttbatch = button.data('ttbatch') 
              var tttype = button.data('tttype') 
              var ttsubject = button.data('ttsubject') 
              var ttfaculty = button.data('ttfaculty') 
              var modal = $(this)
              $('#editform').attr("action","/time-table/"+ttid);
              modal.find('.modal-body #tt_id').val(ttid);
              modal.find('.modal-body #ttday').attr("value",ttday);
              modal.find('.modal-body #tttime').attr("value",tttime);
              modal.find('.modal-body #ttbatch').attr("value",ttbatch);
              modal.find('.modal-body #tttype').attr("value",tttype);
              modal.find('.modal-body #ttsubject').attr("value",ttsubject);
              modal.find('.modal-body #ttfaculty').attr("value",ttfaculty);
              modal.find('.modal-body #ttdepartment').attr("value",ttdepartment);
            })
            $('#newedit').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) 
              var uniqueid = button.data('uniqueid') 
              var department = button.data('department') 
              var batch = button.data('batch') 
              var description = button.data('description') 
              var subject = button.data('subject') 
              var type = button.data('type') 
              var read = button.data('read') 
              var modal = $(this)
              $('#noteeditform').attr("action","/tasknote/"+uniqueid);
              //modal.find('.modal-body #read').attr("value",read);
              modal.find('.card-body #departmente').attr("value",department);
              modal.find('.card-body #batche').attr("value",batch);
              modal.find('.card-body #typee').attr("value",type);
              modal.find('.card-body #subjecte').attr("value",subject);
              modal.find('.card-body #descriptione').val(description);
              modal.find('.card-body #typeshowe').val(type);
            })
            $('#delete').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) 
              var ttid = button.data('ttid') 
              var modal = $(this)
              $('#delform').attr("action","/time-table/"+ttid);
              modal.find('.modal-body #ttdid').val(ttid);
            })
            $('#delete1').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) 
              var rid = button.data('rid') 
              var modal = $(this)
              $('#delformR').attr("action","/results/"+rid);
              modal.find('.modal-body #rid').val(rid);
            })
            $('#ndelete').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) 
              var nid = button.data('nid') 
              var type = button.data('type') 
              var modal = $(this)
              $('#delformnote').attr("action","/tasknote/"+nid);
              modal.find('.modal-body #nid').val(nid);
              modal.find('.modal-body #type').val(type);
            })
            $('#deletenotes').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) 
              var nid = button.data('noteid') 
              var modal = $(this)
              $('#delnoteform').attr("action","/notes/"+nid);
              modal.find('.modal-body #noteid').val(nid);
            })
        </script>
        <script>
          function readURL(input) {
            if (input.files && input.files[0]) {
              var reader = new FileReader();
              
              reader.onload = function(e) {
                $('#imgpreview').attr('src', e.target.result);
              }
              
              reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
          }

          $("#dp").change(function() {
            readURL(this);
          });
        </script>
        @stack('js')
    </body>
</html>