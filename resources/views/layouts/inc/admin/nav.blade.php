 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">

      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('admin/dashboard') }}" class="nav-link">Home</a>
      </li>
      <!-- Navbar Search -->
      <li class="nav-item">
        <!-- Search Form -->
          <div class="form-inline">
              <div class="input-group" data-widget="sidebar-search">
              <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                  <button class="btn btn-sidebar">
                  <i class="fas fa-search fa-fw"></i>
                  </button>
              </div>
              </div>
          </div>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
              <ul class="navbar-nav">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="{{ url('users/profile/'.auth()->user()->id) }}" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    @if (Auth::user()->profile->image)
                        <img src="{{ asset(Auth::user()->profile->image) }}" alt="profile" style="width:32px;height:32px;border-radius:50%">
                    @else
                        <img src="{{ asset('uploads/users/dummy/dummy.jfif') }}" alt="profile" style="width:32px;height:32px;border-radius:50%">
                    @endif

                    <span>{{ Auth::user()->name }}</span>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                    <li>
                        <a href="{{ url('users/profile') }}" class="dropdown-item">
                            <i class="fa fa-user text-primary"></i>
                            Profile
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();">
                                          <i class="fa fa-sign-out text-primary"></i>{{ __('Logout') }}

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                        </form>
                        </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </li>
      </ul>
  </nav>
  <!-- /.navbar -->
