<!-- Main Header -->
  <header class="main-header">
    <!-- Logo -->
    <a href="{{ route('dashboard') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Radical</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Radicalhash</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                  <!-- Menu Toggle Button -->
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <!-- The user image in the navbar-->
                      <img src="{{ asset('public/img/avatar.png') }}"
                           class="user-image" alt="User Image"/>
                      <!-- hidden-xs hides the username on small devices so only the image appears. -->
                      <span class="hidden-xs">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span><span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                     <li>
                    <a  href="{{ route('edit-profile') }}">Edit Profile</a>
             </li>
                       <li>
                    <a  href="{{ route('change-password') }}">Change Password</a>
             </li>
                      <li><a href="{{ route('admin.logout') }}"
                                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                  Sign out
                              </a>
                              <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                  {{ csrf_field() }}
                              </form>
                      </li>

                     
                  </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#"></a>
              </li>
          </ul>
      </div>
    </nav>
  </header>