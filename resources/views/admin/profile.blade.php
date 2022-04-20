@extends('admin.layout.template')

@section('contents')
<div id="profileRender">
<style>
    .profile-pic {
    border-radius: 50%;
    height: 150px;
    width: 150px;
    background-size: cover;
    background-position: center;
    background-blend-mode: multiply;
    vertical-align: middle;
    text-align: center;
    color: transparent;
    transition: all .3s ease;
    text-decoration: none;
    cursor: pointer;
}

.profile-pic:hover {
    background-color: rgba(0,0,0,.5);
    z-index: 10000;
    color: #fff;
    transition: all .3s ease;
    text-decoration: none;
}

.profile-pic span {
    display: inline-block;
    padding-top: 4.5em;
    padding-bottom: 4.5em;
}

form input[type="file"] {
          display: none;
          cursor: pointer;
 }
</style>
<div id="alert_for_update">
</div>
  <!-- Password Change Modal -->
  <div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="changePasswordLabel">Change Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" id="changePasswordForm">
              @csrf
              <div class="form-group row">
                <label for="old_password" class="col-sm-2 col-form-label">Old Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" name='old_password'>
                  <input type="hidden" name="user_id" value="{{$admin->id}}">
                  <div class="error" id="error_old_password"></div>
                </div>
              </div>
              <div class="form-group row">
                <label for="new_password" class="col-sm-2 col-form-label">New Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" name='new_password'>
                  <div class="error" id="error_new_password"></div>
                </div>
              </div>
              <div class="form-group row">
                <label for="confirm_password" class="col-sm-2 col-form-label">Confirm Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" name='confirm_password'>
                  <div class="error" id="error_confirm_password"></div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>
          </form>
        </div>
        <div class="modal-footer">
        
        </div>
      </div>
    </div>
  </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <form action="" id="changeProfilePic" class="text-center" method="post" enctype="multipart/form-data">
                    <label for="fileToUpload">

                @if(!empty($admin->profile_image))
                  <div class="profile-pic " style="background-image: url('{{asset('/').('images/'.($admin->profile_image ?? 'user_default.png'))}}')">
                      <span><i class="fas fa-camera"></i>
                      </span>
                      <span>Change Image</span>
                  </div>
                  @else
                  <div class="profile-pic " style="background-image: url('{{asset('img/user2-160x160.jpg')}}')">
                    <span><i class="fas fa-camera"></i>

                    </span>
                    <span>Change Image</span>
                </div>
                @endif

                  </label>
                  <input type="File" accept="image/*" name="new_profile_image" id="fileToUpload">
                </form>
                {{-- <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="{{asset('/').('images/'.($admin->profile_image ?? 'user_default.png'))}}" alt="User profile picture">
                </div> --}}

                <h3 class="profile-username text-center">{{$admin->first_name." ".$admin->last_name}}</h3>

                <!-- <p class="text-muted text-center">Software Engineer</p> -->

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Phone</b> <a class="float-right">{{$admin->phone}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right">{{$admin->email}}</a>
                  </li>
                  <!-- Password Change Modal -->
                  <li class="list-group-item">
                   
        
                  </li>
                  <!-- <li class="list-group-item">
                    <b>Friends</b> <a class="float-right">13,287</a>
                  </li> -->
                </ul>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#changePassword">
                    Change Password
                  </button>


                <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <!-- <div class="card-header p-2"> -->
                <!-- <ul class="nav nav-pills"> -->
                  <!-- <li class="nav-item"><a class="nav-link active" href="#notifications" data-toggle="tab">Notifications</a></li>
                  <li class="nav-item"><a class="nav-link" href="#update_profile" data-toggle="tab">Update Profile</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li> -->
                <!-- </ul> -->
              <!-- </div> -->
              <!-- /.card-header -->
              <!-- <div class="card-body"> -->
                <div class="tab-content">
                  <div class="tab-pane" id="activity">
                   <!-- settings section -->
                  </div>
                  <!-- /.tab-pane -->
                  <div class="active tab-pane" id="notifications">
                    <!-- The timeline -->
                    
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="update_profile">
                    <form class="form-horizontal" id="admin_profile_update" action="{{url('admin/updateProfile')}}" method="post">
                      @csrf
                      <div class="form-group row">
                        <label for="first_name" class="col-sm-2 col-form-label">First name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name"  value="{{$admin->first_name}}">
                          <div class="error" id="first_name_error"></div>

                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="last_name" class="col-sm-2 col-form-label">Last name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name"  value="{{$admin->last_name}}">
                          <div class="error" id="last_name_error"></div>
                      </div>
</div>
                      <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="email" name="email" placeholder="Email"  value="{{$admin->email}}">
                          <div class="error" id="email_error"></div>
                      </div>
</div>
                      <div class="form-group row">
                        <label for="phone" class="col-sm-2 col-form-label">Phone Number</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Phone"  value="{{$admin->phone_number}}">
                          <div class="error" id="phone_number_error"></div>
                        </div>
                      </div>
                      <!-- <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        <div class="error" id="password_error"></div>
                      </div>
</div>
                      <div class="form-group row">
                        <label for="confirm_password" class="col-sm-2 col-form-label">Confirm Password</label>
                        <div class="col-sm-10">
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                        <div class="error " id="confirm_password_error"></div>
                      </div>
                      </div> -->
                      <!-- <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="terms"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div> -->
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-success">Submit</button>
                          <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            <!-- </div> -->
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script>
    function getFormWithImage(id) {
            let form = document.querySelector(`#${id}`);
            let data = new FormData(form);
            return data;
        }


$("#fileToUpload").change(function (e) {
    $("#changeProfilePic").submit();
 })

    $(document).on('submit','#changeProfilePic',function(e){
  e.preventDefault();
  data = getFormWithImage("changeProfilePic");
  console.log(data);
    $.ajax({
        type:'post',
        url:"{{route('users-change-image')}}",
        dataType: "JSON",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        xhr: function() {
            myXhr = $.ajaxSettings.xhr();
            return myXhr;
        },
        cache: false,
        contentType: false,
        processData: false,
        data:data,
        success:function(data){
            $('#changePassword').modal('hide');
             location.reload();
            // $("#render_test").empty().html(data);
        //     $("#alert_for_update").append(
        //   `<div class="alert alert-success alert-block"><button type="button" class="close" data-dismiss="alert">×</button><strong>Image Updated Success Fully</strong></div>`
        //     );
        },
        error:function(data){
        }
      });
    });
    $(document).on('submit','#changePasswordForm',function(e){
  e.preventDefault();
    const data=getformdata("changePasswordForm");
  console.log(data);
    $.ajax({
        type:'post',
        url:"{{route('users-change-password')}}",
        dataType: "JSON",
       xhr: function() {
             myXhr = $.ajaxSettings.xhr();
             return myXhr;
       },
        data:data,
        success:function(data){
            $('#changePassword').modal('hide');
        },
        error:function(data){
          $.each(data.responseJSON.errors, function(id,msg){
            $('#error_'+id).html(msg);
          })
        }
      });
    });

  
</script>

</div>
@endsection
