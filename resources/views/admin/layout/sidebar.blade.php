  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
      <li class="nav-item menu-open">
        <ul class="nav nav-treeview">
          <li class="nav-item">
          <li class="nav-item">
          <a href="{{url('/admin/dashboard')}}" class="nav-link">
              <i class="fa fa-home nav-icon"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('/admin/profile')}}" class="nav-link">
              <i class="fa fa-id-badge nav-icon"></i>
              <p>Profile</p>
            </a>
          </li>
        </ul>
      </li>
     
      <li class="nav-item">
        <a href="{{url('/admin/category')}}" class="nav-link">
        <i class="fa fa-building-o nav-icon"></i>
          <p>
            Service category
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{url('/admin/services')}}" class="nav-link">
        <i class="fa fa-wrench nav-icon"></i>
          <p>
            Services
          </p>
        </a>
      </li>

    <li class="nav-item">
        <a href="{{url('/admin/subscription')}}" class="nav-link">
        <i class="fa fa-rocket nav-icon"></i>
          <p>
            Subscription
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{url('/admin/splashscreen')}}" class="nav-link">
        <i class="fa fa-desktop nav-icon"></i>
        <!-- <i class="fa fa-mobile nav-icon"></i> -->
          <p>
            Splash screen
          </p>
        </a>
      </li>

      <li class="nav-item">
        <!-- <a href="{{url('/admin/user')}}" class="nav-link"> -->
        <a href="" class="nav-link">
          <i class="fa fa-user-circle nav-icon"></i>
          <p>Users</p>
        </a>
      </li>
     <!--Users Start Here-->
     <li class="nav-item">
        <a href="javascript:void(0)" class="nav-link d-flex">
           <span><i class="nav-icon fa fa-users"></i></span>
          <p>Users</p>
          <i class="right fa fa-angle-left"></i>
        </a>
        <ul class="nav nav-treeview" style="display: {{ Request::routeIs('customer')|| Request::routeIs('viewserviceprovider') ? 'block' : 'none' }}">
          <li class="nav-item">
            <a href="{{route('customer')}}" class="nav-link  {{ Request::routeIs('customer') ? 'active' : '' }}">
              <i class="fa fa-user-circle nav-icon"></i>
              <p>Customers</p>
            </a>
          </li>
      <!-- <li class="nav-item">
        <a href="{{url('/admin/customer')}}" class="nav-link  {{ Request::routeIs('admin.customer') ? 'active' : '' }}">
          <i class="fa fa-user-circle nav-icon"></i>
          <p>
            customer
          </p>
        </a>
      </li> -->
      <li class="nav-item">
            <a href="{{route('viewserviceprovider')}}" class="nav-link  {{ Request::routeIs('viewserviceprovider') ? 'active' : '' }}">
              <i class="fa fa-circle nav-icon"></i>
              <p>Service Providers</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a href="{{url('/admin/splashscreen')}}" class="nav-link">
       <i class="fa fa-question-circle nav-icon"></i>
        <!-- <i class="fa fa-mobile nav-icon"></i> -->
          <p>
            Queries
          </p>
        </a>
      </li>
     <!--Users End-->
      <li class="nav-item">
        <a href="{{url('/admin/logout')}}" class="nav-link">
          <i class="fa fa-sign-out nav-icon"></i>
          <p>
            Logout
          </p>
        </a>
      </li>


    </ul>
  </nav>
  <!-- /.sidebar-menu -->
  <script>
    $(document).ready(function() {
      var fullpath = window.location.pathname;
      // console.log(fullpath);
      var filename = fullpath.replace(/^.*[\\\/]/, '');
      var last = "{{url('/')}}/admin/" + filename;
      var currentLink = $('a[href="' + last + '"]'); //Selects the proper a tag
      currentLink.addClass("active");
    });
  </script>
   <script>
     $(document).ready(function() {
        var scroll = window.sessionStorage.getItem("scroll");
    $("div.os-viewport").scrollTop(scroll);
    var fullpath = window.location.pathname;
    var last = "{{url('/')}}/admin/" + fullpath.split('/')[4];
    var currentLink = $('a[href="' + last + '"]'); //Selects the proper a tag
    currentLink.addClass("active");
    
    });

    $(document).ready(function(){  
    $("a").click(function(){  
        var scroll = $("div.os-viewport").scrollTop();
        window.sessionStorage.setItem("scroll", scroll);
    });  
});  

$(document).ready(function(){
    var parent = $("a.active").parent().parent().parent();
    parent.addClass("menu-is-opening menu-open");
});
    </script>