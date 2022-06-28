  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
     
          <li class="nav-item">
            <a href="{{url('/admin/dashboard')}}" class="nav-link">
              <i class="fa fa-home nav-icon"></i>
              <p>Dashboard</p>
            </a>
          </li>
       
        <li class="nav-item">
        <a href="{{url('/admin/customer')}}" class="nav-link">
        <i class="fa fa-user nav-icon"></i>
          <p>
            Customers
          </p>
        </a>
      </li>

        <li class="nav-item {{ Request::routeIs('company')|| Request::routeIs('viewserviceprovider') ? ' menu-open' : '' }}">
        <a href="" class="nav-link d-flex">
           <span><i class="nav-icon fa fa-server"></i></span>
          <p>Service Provider</p>
          <i class="right fa fa-angle-right"></i>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('company')}}" class="nav-link  {{ Request::routeIs('company') ? 'active' : '' }}">
              <i class="fa fa-users nav-icon"></i>
              <p>Company</p>
            </a>
          </li>
    
      <li class="nav-item">
            <a href="{{route('viewserviceprovider')}}" class="nav-link  {{ Request::routeIs('viewserviceprovider') ? 'active' : '' }}">
              <i class="fa fa-child nav-icon"></i>
              <p>Individual</p>
            </a>
          </li>
        </ul>
      </li>

    <!--Category Start Here-->
     <li class="nav-item">
            <a href="{{url('/admin/category')}}" class="nav-link">
              <i class="fa fa-building-o nav-icon"></i>
              <p>Category</p>
            </a>
          </li>
        <li class="nav-item">
            <a href="{{url('/admin/subcategory')}}" class="nav-link">
              <i class="fa fa-cogs nav-icon"></i>
              <p>Services</p>
            </a>
          </li>
        
        <!-- <li class="nav-item">
        <a href="{{url('/admin/services')}}" class="nav-link">
        <i class="fa fa-wrench nav-icon"></i>
          <p>
            Services
          </p>
        </a>
      </li> -->

    <li class="nav-item">
        <a href="{{url('/admin/subscription')}}" class="nav-link">
        <i class="fa fa-rocket nav-icon"></i>
          <p>
            Subscription
          </p>
        </a>
      </li>
    
      <li class="nav-item">
        <a href="{{route('view-cities')}}" class="nav-link">
        <i class="fa fa-building nav-icon"></i>
          <p>
            Manage City
          </p>
        </a>
      </li>
     

      <li class="nav-item">
        <a href="{{url('/admin/query')}}" class="nav-link">
       <i class="fa fa-question-circle nav-icon"></i>
         <p>
            Queries
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{url('/admin/contactquery')}}" class="nav-link">
       <i class="fa fa-question-circle nav-icon"></i>
         <p>
            Contact Queries
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('/deletedproviders')}}" class="nav-link  {{ Request::routeIs('provider.removed') ? 'active' : '' }}">
       <i class="fa fa-question-circle nav-icon"></i>
         <p>
            Deleted Users
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('/admin/staticcontent')}}" class="nav-link  {{ Request::routeIs('staticcontent') ? 'active' : '' }}">
          <i class="fa fa-picture-o nav-icon"></i>
          <p>Screen Banner image</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('condition')}}" class="nav-link  {{ Request::routeIs('condition') ? 'active' : '' }}">
          <i class="fa fa-pencil nav-icon"></i>
          <p>Terms and Condition</p>
        </a>
      </li>
       <!--Static content Start Here-->
     {{-- <li class="nav-item {{ Request::routeIs('staticcontent')|| Request::routeIs('condition') ? ' menu-open' : '' }}">
        <a href="" class="nav-link d-flex">
           <span><i class="fa fa-twitter nav-icon"></i></span>
          <p>Static content</p>
          <i class="right fa fa-angle-right"></i>
        </a>
        <ul class="nav nav-treeview" >
          <li class="nav-item">
            <a href="{{url('/admin/staticcontent')}}" class="nav-link  {{ Request::routeIs('staticcontent') ? 'active' : '' }}">
              <i class="fa fa-picture-o nav-icon"></i>
              <p>Screen Banner image</p>
            </a>
          </li>
    
      <li class="nav-item">
            <a href="{{route('condition')}}" class="nav-link  {{ Request::routeIs('condition') ? 'active' : '' }}">
              <i class="fa fa-pencil nav-icon"></i>
              <p>Terms and Condition</p>
            </a>
          </li>
        </ul>
      </li> --}}
      <li class="nav-item">
        <a href="{{url('/admin/splashscreen')}}" class="nav-link">
        <i class="fa fa-desktop nav-icon"></i>
          <p>
            Splash screen
          </p>
        </a>
      </li>
   
      
        <li class="nav-item">
        <a href="{{url('/admin/report')}}" class="nav-link">
       <i class="fa fa-file nav-icon"></i>
         <p>
            Report
          </p>
        </a>
      </li>
      <!-- Users End-->
      <li class="nav-item">
        <a href="{{route('payment')}}" class="nav-link {{ Request::routeIs('payment') ? 'active' : '' }}">
          <i class="fa fa-paypal nav-icon"></i>
          <p>
            Payment History
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

// $(document).ready(function(){
//     var parent = $("a.active").parent().parent().parent();
//     parent.addClass("menu-is-opening menu-open");
// });
</script>
