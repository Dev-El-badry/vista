<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset('manage/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">

        <p>{{ Auth::user()->name }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
   
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">Main</li>
      <li class="active">
        <a href="#">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span> 

        </a>
       
      </li>

       <li class="treeview">
        <a href="">
          <i class="fa fa-tags"></i> <span>Cronic Disease Categories</span> 
           <i class="fa fa-angle-left pull-right"></i>
        </a>

          <ul class="treeview-menu">
     
          <li>
            <a href="{{ route('cronic_disease_category.index') }}">
            <i class="fa fa-circle-o"></i>
            Manage Cronic Diseases</a>
          </li>
          <li>
            <a href="{{ route('cdc.get_requests') }}">
            <i class="fa fa-circle-o"></i>
            Requests Cronic Diseases</a>
          </li>
        </ul>
       
      </li>

       <li class="">
        <a href="{{ route('users.index') }}">
          <i class="fa fa-users"></i> <span>Manage Users</span> 
        </a>
       
      </li>


      <li class="treeview">
        <a>
          <i class="fa fa-map-signs fa-fw"></i> <span>Permissions & Roles</span> 
          <i class="fa fa-angle-left pull-right"></i>
        </a>

       
        <ul class="treeview-menu">
     
          <li>
            <a href="{{ route('permissions.index') }}">
            <i class="fa fa-circle-o"></i>
            Permissions</a>
          </li>
          <li>
            <a href="{{ route("roles.index") }}">
            <i class="fa fa-circle-o"></i>
            Roles</a>
          </li>
        </ul>
       
      </li> 

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
