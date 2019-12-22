<nav class="navbar nav-custom-2 navbar-horizontal navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="font-weight-bold text-sm text-white" href="javascript:;">
            <img width="34" height="34" src="{{ asset('assets/img/time3.png') }}">
            {{ date('h:i A') }}
        </a>
        <button class="navbar-toggler fa-white" type="button" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars fa-white"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-default">

            <div class="navbar-collapse-header nav-link">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="javascript:;">
                            <img src="{{ asset('assets/img/blue.png') }}">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            @if ($session)

            <ul class="navbar-nav ml-lg-auto">
                <li class="nav-item">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media align-items-center">
                          <span class="avatar avatar-sm rounded-circle">
                              <img alt="Image placeholder" src="{{asset('assets/img/man-1.png')}}">
                          </span>
                          <div class="media-body ml-2 d-none d-lg-block">
                              <span class="mb-0 text-sm text-white  font-weight-bold">
                                  Kasir
                              </span>
                          </div>
                        </div>
                    </a>

                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                        <div class=" dropdown-header noti-title">
                          <h6 class="text-overflow text-dark m-0">Welcome!</h6>
                        </div>
                        <a href="javascript:;" class="dropdown-item">
                          <i class="ni ni-single-02"></i>
                          <span>My profile</span>
                        </a>
                        <div class="dropdown-divider"></div>
                          <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item">
                              <i class="ni ni-user-run"></i>
                              <span>Logout</span>
                          </a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                    </div>

                </li>
            </ul>
            @else

            @endif
        </div>
    </div>
</nav>
