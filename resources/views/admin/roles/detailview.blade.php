
@extends('admin.layout.template')
@section('contents')
<div id="users_data">
<div class="card">
              <div class="card-header">
                <h3 class="card-title">User</h3>
                @include('admin.user.back')
              </div>
              <!-- /.card-header -->
             <div class="card-body">
              
                      <div class="form-group row">
                        <label for="first_name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="name" value="{{$data[0]->name}}" readonly>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="Email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" value="{{$data[0]->email}}" readonly>
                          </div>
                      </div>
                      
                      

                </div>
</div>

</div>
@endsection