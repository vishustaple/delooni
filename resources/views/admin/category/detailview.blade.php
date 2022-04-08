@extends('admin.layout.template')
@section('contents')
<!-- <div class="card" id = "test">
    <div class="card-header">
    <h3 class="card-title">Category detailView</h3>
    @include('admin.category.back')
</div> -->



<div class="card">
              <!-- /.card-header -->
              <div class="back-div row pt-2 align-items-center">
                
                  <h3 class="h5 text-center mb-0">Category detailView</h3>
              
               
                <div class="col-sm-6">
                @include('admin.category.back')
                </div>
              

<form class="form-horizontal"  id="update_category"  method="post"  enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="id"  id="id"  value=""> 
                      <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Name :</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="name" value="{{$data->name}}"  name="name" placeholder="Enter Your Name" readonly>
                          <div class="error" id="error_name">
                         </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label">Description :</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="description"  value="{{$data->description}}"  name="description" placeholder="Enter Description" readonly>
                          <div class="error" id="error_description">
                          </div>
                        </div>
                      </div>
                 <div class="form-group row">
                        <label for="service_category_image" class="col-sm-3 col-form-label">Service Category Image :</label>
                        <div class="col-sm-8">
                          <input type="file" class="form-control" value="{{$data->service_category_image}}"  id="service_category_image" name="service_category_image" placeholder="Upload Service category Image" readonly>
                          <div class="error" id="error_service_category_image">
                         </div>
                        </div>
                      </div>                    
                    </form>
</div>
</div>
@endsection