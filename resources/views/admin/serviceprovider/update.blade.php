<div class="card">
              <div class="card-header">
                <h3 class="card-title">Updateuser</h3>
                @include('admin.user.back')
              </div>
              <!-- /.card-header -->
             
             <div class="card-body" id="updateUser">
             <form class="form-horizontal" action="{{url('/')}}/admin/user/updateuserdata" id="update_user" method="post">
                      @csrf
                      <input type="hidden" name="id" value="{{$value->id}}">
                      <!-- <input type="hidden" class="form-control" name="created_by" value="{{$value->id}}"> -->
                      <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                         <input type="text" class="form-control" id="name" name="name" value="{{$value->name}}">
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email" value="{{$value->email}}">
                          </div>
                      </div>
                     
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-success">Update</button>
                          <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                      </div>
                </form>
                </div>
</div>
<script>
// $("#update_user").on('submit',(e)=>{
//     e.preventDefault();
    
//     const value=getformvalue("update_user");
//     UserAjax('post','/admin/user/update/',value);
// });


</script>