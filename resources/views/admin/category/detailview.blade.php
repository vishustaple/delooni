@extends('admin.layout.template')
@section('contents')
<div class="card" id = "test">
    <div class="card-header yellow-bg">
      <div class="row align-items-center">
        <div class="col-md-6">
        <h3 class="card-title mb-0">Category Detail View</h3>
       </div>
    @include('admin.category.back')
   </div>
</div>
<div class="card-body">
<form class="form-horizontal"  id="update_category"  method="post"  enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="id"  id="id"  value=""> 
                      <div class="form-group row">
                        <label for="name" class="col-sm-12 col-form-label">Name</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="name" value="{{$data->name}}"  name="name"  readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="description" class="col-sm-12 col-form-label">Description</label>
                        <div class="col-sm-12">
                          <textarea class="form-control" id="description"   name="description"  readonly>{{$data->description}}</textarea>
                       </div>
                      </div>
                      <div class="form-group row uploadimage">
                        <label for="service_category_image" class="col-sm-12 col-form-label">Service Category Image</label>
                        <div class="col-sm-12">
                        <img src="{{URL::to('/')}}/profile_image/{{$data->service_category_image}}">
                          </div>
                      </div>  
                    </form>
</div>
</div>
<div class="card" id="data">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" style="cursor:pointer" 
                        data-toggle="modal" 
                        data-target="#myModal">Add sub category</a></li>
                   <!-- The Modal -->
                    <div class="modal" id="myModal"> 
                      <div class="modal-dialog modal-md">
                        <div class="modal-content">
                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h5 class="modal-title">Add category</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                           
                          <!-- Modal body -->
                          <div class="modal-body">
                          @include('admin.category.add_subcategory')
                          </div>
                        </div>
                      </div>
                    </div>
                    </div>    
<!-- /.card-header -->
<div class="card" id = "test">
  <div class="table-responsive">
  <table class="table">
    @if(count($getdatas)>0)
    <thead>
    <tr>
    <th style="width: 10px">S.no.</th>
    <th>Name</th>
    <th>Sub category image</th>
    <th>Parent category</th>
    <th>Status</th>
    <th>Action</th>
    </tr>
    </thead>
    @endif
    <tbody>
      @forelse($getdatas as $key=>$value)
        <tr>
        <td>{{$key+1}}</td>
        <td>{{$value->name}}</td>
        <td>
        <img src="{{URL::to('/')}}/profile_image/{{$value->service_category_image}}" width="100px" height="100px">
        </td>
        <td>{{$value->is_parent}}</td>
        <td>@if($value->status==1)
    <button data-id="{{$value->id}}" class="disable_enable btn btn-success btn-xs" onclick="toggleDisableEnable(this)">Activate</button>
    @else
    <button data-id="{{$value->id}}" class="disable_enable btn btn-danger btn-xs" onclick="toggleDisableEnable(this)">Deactivate</button>
    @endif
    </td>
    <td>
    <!-- <a href='{{route("category.view", $value->id)}}'   target="_blank" class="btn btn-outline-success btn-xs view">View</a> -->
    <button data-id="{{$value->id}}" style="cursor:pointer" data-toggle="modal" data-target="#myModal1" class="btn btn-outline-success btn-xs update" class="viewjob_update">Update</button>
    <!-- The Modal -->
    <div class="modal " id="myModal1">
    <div class="modal-dialog modal-md">
    <div class="modal-content">
   <!-- Modal Header -->
   <div class="modal-header">
    <h5 class="modal-title">Update</h5>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <!-- Modal body -->
    <div class="modal-body viewJob_update">
    </div>

</div>
</div>
</div>
<button data-id="{{$value->id}}" class="btn btn-danger btn-xs remove">Remove</button>
    </td>
    </tr>
    @empty
    <center>
    <h3> Sub Category is not Available </h3>
    </center>
    @endforelse
</tbody>
</table>
</div>
</div>
@endsection

   

  