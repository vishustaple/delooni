<div class="card">
<form method="post" action="{{route('roles.update',$role->id ?? '')}}" >
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Role Name</label>
                            <input type="text" class="form-control" name="role" value="{{$role->name??''}}" id="permission" placeholder="Enter Role Name">
                            @error('role')
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
<script>
// $("#update_user").on('submit',(e)=>{
//     e.preventDefault();
    
//     const value=getformvalue("update_user");
//     UserAjax('post','/admin/user/update/',value);
// });


</script>