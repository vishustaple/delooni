@extends('admin.layout.template')
@section('contents')
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
                    <form method="post" action="{{route('rolesPermission.store')}}" >
                        @csrf
                        <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Select Roles</label>
                            <!-- <input type="text" class="form-control" name="role" id="role" placeholder="Enter Role Name"> -->
                            <select name="role" id="role" class="selectpicker" data-live-search="true">
                              <option value="">Select Role</option>
                              @foreach($roles as $role)
                              <option value="{{$role->id}}">{{$role->name}}</option>
                              @endforeach
                            </select>
                            
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Select Permissions</label>
                            <!-- <input type="text" class="form-control" name="role" id="role" placeholder="Enter Role Name"> -->
                            <select name="permissions[]" id="permissions" class="selectpicker" data-live-search="true" multiple>
                              <option value="">Select Permissions</option>
                              @foreach($permissions as $permission)
                              <option value="{{$permission->id}}">{{$permission->name}}</option>
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
    <script>
        $(".selectpicker").selectpicker({
                "title": "Select Options"
            }).selectpicker("render");
        var myEditor;

        InlineEditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
            console.log( 'Editor was initialized', editor );
            myEditor = editor;
        } )
        .catch( err => {
            console.error( err.stack );
        } );
        $(document).ready(function (){
        $(".ck-file-dialog-button").hide();
        $(".ck-dropdown__button").hide();
        })
    </script>
@endsection
