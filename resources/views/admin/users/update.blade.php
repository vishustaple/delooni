<div class="card">
            
              <!-- /.card-header -->
             
             <div class="card-body" id="updateUser">
             <form method="post" action="{{route('manage-users-update',$user->id)}}" >
                        @csrf
                        <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Select Roles</label>
                            <input type="text" class="form-control" name="user" value="{{$user->name}}" id="user" placeholder="Enter Role Name" readonly >
                            @error('user')
                                <div class="error error-msg-red">{{ $message }}</div>
                            @enderror
                        </div>
                        
                <div class="form-group">
                    <label for="exampleInputEmail1">Select Permissions</label>
                    <select name="roles[]" id="roles" class="form-control">
                        <option value="">Select Permissions</option>
                        @foreach($roles as $role)
                        <option value="{{$role->id}}" {{in_array ( $role->id, $rolesdata)?'selected':''}}>{{$role->name}}</option>
                        @endforeach
                    </select>
                    @error('roles')
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