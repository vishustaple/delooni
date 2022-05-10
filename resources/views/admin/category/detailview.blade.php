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
                        <img class="lazyload" src="{{URL::to('/')}}/profile_image/{{$data->service_category_image}}">
                          </div>
                      </div>  
                    </form>
</div>
</div>

@endsection

   

  