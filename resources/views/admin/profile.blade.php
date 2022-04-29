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
        <div class="modal-header yellow-bg">
          <h5 class="modal-title" id="changePasswordLabel">Change Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" id="changePasswordForm">
              @csrf
              <div class="form-group row">
                <label for="old_password" class="col-sm-12 col-form-label">Old Password</label>
                <div class="col-sm-12">
                  <input type="password" class="form-control" name='old_password' placeholder="Old Password">
                  <input type="hidden" name="user_id" value="{{$admin->id}}" >
                  <div class="error" id="error_old_password"></div>
                </div>
              </div>
              <div class="form-group row">
                <label for="new_password" class="col-sm-12 col-form-label">New Password</label>
                <div class="col-sm-12">
                  <input type="password" class="form-control" name='new_password' placeholder="New Password">
                  <div class="error" id="error_new_password"></div>
                </div>
              </div>
              <div class="form-group row">
                <label for="confirm_password" class="col-sm-12 col-form-label">Confirm Password</label>
                <div class="col-sm-12">
                  <input type="password" class="form-control" name='confirm_password' placeholder="Confirm Password">
                  <div class="error" id="error_confirm_password"></div>
                </div>
              </div>
              <div class="form-group row mb-0">
                <div class="col-sm-12 text-center">
                  <button type="submit" class="btn btn-success app-button btn-md">Submit</button>
                </div>
              </div>
          </form>
        </div>
       
      </div>
    </div>
  </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header yellow-bg">
            <h3 class="card-title">Admin Profile</h3>
          </div>
          <div class="card-body">
            <div class="row">
          <div class="col-md-4 d-flex">

            <!-- Profile Image -->
            <div class="card w-100">
              <div class="card-body box-profile">
                <form action="" id="changeProfilePic" class="text-center" method="post" enctype="multipart/form-data">
                    <label for="fileToUpload" class="profile-image-wrap">

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

                <h3 class="profile-username text-center text-capitalize py-3">{{$admin->first_name." ".$admin->last_name}}</h3>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


          </div>


          <div class="col-md-8 d-flex">
              <div class="card w-100">
                 <div class="card-body">
                 <ul class="list-group list-group-unbordered border-0 mb-3">
                  <li class="list-group-item border-top-0 d-flex justify-content-between">
                    <b>Phone</b> <span>{{$admin->phone}}</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between">
                    <b>Email</b> <span>{{$admin->email}}</span>
                  </li>
                 
                </ul>

                <div class="text-center mt-5">
                <button type="button" class="btn btn-primary mx-auto app-button" data-toggle="modal" data-target="#changePassword">
                    Change Password
                  </button>
                </div>
                 </div>
              </div>
          </div>
            </div>
          </div>
          
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
            location.reload();
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
