<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
  <div class="container-fluid">
    <div class="navbar-wrapper">
      <a class="navbar-brand" href="#">{{ $titlePage }}</a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
    <span class="sr-only">Toggle navigation</span>
    <span class="navbar-toggler-icon icon-bar"></span>
    <span class="navbar-toggler-icon icon-bar"></span>
    <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
      <form class=" navbar-form">
        <div class="input-group no-border">
        <input type="text" value="" class="form-control justify-content-center" placeholder="Search...">
        <button type="submit" class="btn btn-white btn-just-icon">
          <i class="material-icons">search</i>
          <div class="ripple-container"></div>
        </button>
        </div>
      </form>
      <ul class="navbar-nav">
        <li class="nav-item card">
          <a class="nav-link" href="{{ route('home') }}">
            <i class="material-icons">dashboard</i>
            <p class="d-lg-none d-md-block">
              {{ __('Dashboard') }}
            </p>
          </a>
        </li>
        <li class="nav-item dropdown card"  >
          <a class="nav-link " href="#" id="navbarDropdownMenuLink"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="material-icons">notifications</i>
            @php
              $notifcount=0;
              foreach (Auth::user()->tasknote as $notif) 
              {
                if ($notif->read == "undone") 
                {
                  $notifcount=$notifcount+1;
                }
              }
            @endphp
            <span class="notification">{{$notifcount}}</span>
            <p class="d-lg-none d-md-block">
              {{ __('Notifications') }}
            </p>
          </a>
          <div class="dropdown-menu dropdown-menu-right card-body" style="width: 400px" aria-labelledby="navbarDropdownMenuLink">
              <h4 class="dropdown-item  card-header card-header-info" style="font-size: 22px"> Notifications</h4>  
              <br>
              
            @if($notifcount > 0)  
              @foreach(Auth::user()->tasknote as $notif)
                @if($notif->read == "undone" && $notif->type == "Notice")  
                  <a class="dropdown-item  card-header card-header-warning"  href="/home"style="text-overflow:ellipsis; width: 300px; white-space: nowrap; overflow: hidden; word-wrap: break-word; display:block;white-space: initial;">  New {{$notif->type}} : {{$notif->description}} </a>
                @endif
                @if($notif->read == "undone" && $notif->type == "HomeWork")  
                  <a class="dropdown-item  card-header card-header-danger"  href="/home"style="text-overflow:ellipsis; width: 300px; white-space: nowrap; overflow: hidden; word-wrap: break-word; display:block;white-space: initial;">  New {{$notif->type}} : {{$notif->description}} </a>
                @endif
                <br>
              @endforeach
            @else
            <a class="dropdown-item  card-header card-header-info"  href="/home"style="text-overflow:ellipsis; width: 300px; white-space: nowrap; overflow: hidden; word-wrap: break-word; display:block;white-space: initial;"> Ahha! No notifications! ! !</a>
            @endif
            
          </div>
        </li>
        
        <li class="nav-item dropdown card ">
          <a class="nav-link " href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="material-icons ">person</i>
            <p class="d-lg-none d-md-block ">
              {{ __('Account') }}
            </p>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
            <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
            <a class="dropdown-item" href="#">{{ __('Settings') }}</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Log out') }}</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
