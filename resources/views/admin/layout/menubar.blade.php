<ul class="navbar-nav w-100">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('/admin/dashboard')}}" class="nav-link">Dashboard</a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('/admin/create/staff')}}" class="nav-link">Staff</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Finance</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Agencies</a>
      </li> -->
    </ul>

    <div class="dropdown profile-drop ml-auto">
      <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false" class="nav-link txt-loki d-inline-flex align-items-center">
          <div class="sm-profile">
            <img class="profile-img" src="{{asset('/').('images/'.(auth()->user()->profile_image))}}" alt="Profile">
                            </div>
      </a>
      <div class="dropdown-menu p-0" aria-labelledby="dropdownMenuLink" style="left: inherit; right: 0px;">
          <a class="dropdown-item" href="{{url('/admin/profile')}}"><i class="fa fa-user-circle-o pr-2" aria-hidden="true"></i> Profile</a>
          <a class="dropdown-item" href="{{url('/admin/logout')}}"><i class="fa fa-sign-out pr-2" aria-hidden="true"></i> Logout</a>
      </div>
  </div>