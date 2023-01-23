<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('admin/dashboard') }}" class="brand-link" style="text-decoration: none">
      <img src="/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Roulette</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            @if (Auth::user()->profile->image)
                <img src="{{ asset(Auth::user()->profile->image) }}" style="width:32px;height:32px;border-radius:50%" alt="User Image">
            @else
            <img src="{{ asset('uploads/users/dummy/dummy.jfif') }}" style="width:32px;height:32px;border-radius:50%" alt="User Image">
            @endif
        </div>
        <div class="info">
          <a href="{{ url('users/profile/'.auth()->user()->id) }}" class="d-block" style="text-decoration: none">{{ Auth::user()->name }}</a>
        </div>
      </div>



      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <li class="nav-item {{ Request::is('admin/users*') ? 'menu-open' : '' }}">

                <a href="#" class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}">
                  <i class="nav-icon fa fa-users"></i>
                  <p>
                    Users
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a href="{{ url('admin/users') }}" class="nav-link {{ Request::is('admin/users') || Request::is('admin/users/*/edit') ? 'active' : '' }}">
                            <i class="fa fa-users nav-icon"></i>
                            <p>View Users</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="{{ url('admin/users/create') }}" class="nav-link {{ Request::is('admin/users/create') ? 'active' : '' }}">
                            <i class="fa fa-user-plus nav-icon"></i>
                            <p>Create Users</p>
                          </a>
                        </li>
                      </ul>


            </li>
            <li class="nav-item {{ Request::is('admin/receipes*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ Request::is('admin/receipes*') ? 'active' : '' }}">
                <i class="nav-icon fa fa-cutlery"></i>
                <p>
                    Receipes
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                    <ul class=" nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/receipes') }}" class="nav-link {{ Request::is('admin/receipes') || Request::is('admin/receipes/*/edit') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>View Recipes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/receipes/create') }}" class="nav-link {{ Request::is('admin/receipes/create') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Create Receipe</p>
                            </a>
                        </li>
                    </ul>
          </li>

          <li class="nav-item">
            <a href="{{ url('admin/categories') }}" class="nav-link {{ Request::is('admin/categories') ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Categories
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('admin/tables') }}" class="nav-link {{ Request::is('admin/tables') ? 'active' : '' }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Tables
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('admin/orders') }}" class="nav-link {{ Request::is('admin/orders') ? 'active' : '' }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Orders
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
