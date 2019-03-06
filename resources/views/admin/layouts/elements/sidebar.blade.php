  
<?php
use \App\Http\Controllers\Controller;
$route_name=Request::route()->getName();
$route_name=explode('.', $route_name);
$route_name=$route_name[0];
?>
  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

        <li class="{{ ($route_name == 'dashboard') ? 'active' : '' }}">
          <a href="{{ route('dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
       
   


 
      
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>