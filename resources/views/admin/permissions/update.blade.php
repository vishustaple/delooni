<div class="card">
              <div class="card-header">
                <h3 class="card-title">Update Permission</h3>
             
              </div>
              <!-- /.card-header -->
             
             <div class="card-body" id="updateUser">
             <form method="post" action="{{route('permissions.update',$permission->id)}}" >
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Permission Name</label>
                            <input type="text" class="form-control" name="permission" value="{{$permission->name??''}}" id="permission" placeholder="Enter Permission Name">
                            @error('permission')
                                <div class="error error-msg-red">{{ $message }}</div>
                            @enderror
                        </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
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