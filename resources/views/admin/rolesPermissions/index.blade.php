@extends('admin.layout.template')
@section('contents')
      <a href="{{route('rolesPermission.create')}}" class="btn btn-outline-success btn-lg">Assign permissions</a> 
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!--  -->
                <div class="card-body"> 
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Role</th>
                          <th>Permissions</th>
                          <th>Action</th>
                          <!-- <th style="width: 40px">Label</th> -->
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i =0 ?>
                        @foreach($roles as $role)
                          <tr>
                            <td><?php  $i++; echo $i; ?> </td>
                            <td>{{$role->name}}</td>
                            <td>
                              @foreach($role->permissions as $permission)
                              <span class="badge bg-info">{{$permission->name}}</span>
                              @endforeach
                            </td>

                            <td>
                            <a href="{{route('rolesPermission.edit',$role->id)}}" class="btn btn-outline-success btn-sm rounded-pill">Edit</a>
                             </td>
                        </tr>
                        @endforeach
                        
                      </tbody>
                    </table>
                </div>
                <!--  -->
            </div>
        </div>
        
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
@endsection