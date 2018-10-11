 <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>P</span>
      <!-- logo for regular state and mobile devices -->

      <span class="logo-lg">Admin Panel</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">


          @php
            $notifi = \App\Http\Controllers\ManageController::get_notify_admin();

          @endphp

          
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">{{ count($notifi) }}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have {{ count($notifi) }} notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  @foreach ($notifi as $row)
                 
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i>  {{ $row->user->name }} has Documenting this is job: {{ $row->job->title }}
                    </a>
                  </li>
                  @endforeach
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset('manage/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ asset('manage/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                <p>
                 {{ Auth::user()->name }} 
                  <small>Member {{ date('D M y', Auth::user()->create_at) }}</small>
                </p>
              </li>

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Signout</a>
                </div>
              </li>
            </ul>
          </li>
         
        </ul>
      </div>
    </nav>
  </header>