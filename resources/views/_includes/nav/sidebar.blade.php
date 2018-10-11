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


      <li class="treeview">
        <a href="">
          <i class="fa fa-briefcase"></i> <span>Job Titles</span> 
           <i class="fa fa-angle-left pull-right"></i>
        </a>

          <ul class="treeview-menu">
     
          <li>
            <a href="{{ route('job_title.index') }}">
            <i class="fa fa-circle-o"></i>
            Manage Job Titles</a>
          </li>
          <li>
            <a href="{{ route('job_title.get_requests') }}">
            <i class="fa fa-circle-o"></i>
            Requests Job Titles</a>
          </li>
        </ul>
       
      </li>


       <li class="treeview">
        <a href="">
          <i class="fa fa-comment-o"></i> <span>Compliant Titles</span> 
           <i class="fa fa-angle-left pull-right"></i>
        </a>

          <ul class="treeview-menu">
     
          <li>
            <a href="{{ route('compliant_title.index') }}">
            <i class="fa fa-circle-o"></i>
            Manage Compliant Titles</a>
          </li>
          <li>
            <a href="{{ route('compliant_title.get_requests') }}">
            <i class="fa fa-circle-o"></i>
            Requests Compliant Titles</a>
          </li>
        </ul>
       
      </li>

        <li class="treeview">
        <a href="">
          <i class="fa fa-building"></i> <span>Lab Titles</span> 
           <i class="fa fa-angle-left pull-right"></i>
        </a>

          <ul class="treeview-menu">
     
          <li>
            <a href="{{ route('lab_title.index') }}">
            <i class="fa fa-circle-o"></i>
            Manage Lab Titles</a>
          </li>
          <li>
            <a href="{{ route('lab_title.get_requests') }}">
            <i class="fa fa-circle-o"></i>
            Requests Lab Titles</a>
          </li>
        </ul>
       
      </li>



      <li class="treeview">
        <a href="">
          <i class="fa fa-bug"></i> <span>Drug Allergy Titles</span> 
           <i class="fa fa-angle-left pull-right"></i>
        </a>

          <ul class="treeview-menu">
     
          <li>
            <a href="{{ route('drug_allergy_list.index') }}">
            <i class="fa fa-circle-o"></i>
            Manage Drug Allergy Titles</a>
          </li>
          <li>
            <a href="{{ route('drug_allergy_list.get_requests') }}">
            <i class="fa fa-circle-o"></i>
            Requests Drug Allergy Titles</a>
          </li>
        </ul>
       
      </li>  

      <li class="treeview">
        <a href="">
          <i class="fa fa-ambulance"></i> <span>Chronic Drug Titles</span> 
           <i class="fa fa-angle-left pull-right"></i>
        </a>

          <ul class="treeview-menu">
     
          <li>
            <a href="{{ route('chronic_drug_list.index') }}">
            <i class="fa fa-circle-o"></i>
            Manage Chronic Drug Titles</a>
          </li>
          <li>
            <a href="{{ route('chronic_drug_list.get_requests') }}">
            <i class="fa fa-circle-o"></i>
            Requests Chronic Drug Titles</a>
          </li>
        </ul>
       
      </li>

      <li class="">
        <a href="{{ route('request_options.index') }}">
          <i class="fa fa-gear"></i> <span>Manage Request Option</span> 
        </a>
       
      </li>

      <li class="">
        <a href="{{ route('requests.index') }}">
          <i class="fa fa-file-o"></i> <span>Manage Requests</span> 
        </a>
       
      </li>


       <li class="">
        <a href="{{ route('public_users.index') }}">
          <i class="fa fa-users"></i> <span>Manage Users Application</span> 
        </a>
       
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
