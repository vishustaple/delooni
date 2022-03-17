@extends('admin.layout.template')
@section('contents')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!--  -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Assign Permisson</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{route('rolesPermission.update',$roledata->id)}}" >
                        @csrf
                        @method("PUT")
                        <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Select Roles</label>
                            <!-- <input type="text" class="form-control" name="role" id="role" placeholder="Enter Role Name"> -->
                            <select name="role" id="role" class="form-control">
                              <option value="">Select Role</option>
                              @foreach($roles as $role)
                              <option value="{{$role->id}}" {{($roledata->id==$role->id)?'selected':''}} >{{$role->name}}</option>
                              @endforeach
                            </select>
                           
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Select Permissions</label>
                            <!-- <input type="text" class="form-control" name="role" id="role" placeholder="Enter Role Name"> -->
                            <select name="permissions[]" id="permissions" class="form-control select2" multiple>
                              <option value="">Select Permissions</option>
                              @foreach($permissions as $permission)
                              <option value="{{$permission->id}}" {{in_array ( $permission->id, $permissionsdata)?'selected':''}}>{{$permission->name}}</option>
                              @endforeach
                            </select>
                            
                        </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!--  -->
            </div>
        </div>

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
@endsection
