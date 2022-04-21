@extends('admin.layout.template')
@section('contents')
<div class="card" id = "test">
    <div class="card-header">
    <h3 class="card-title">Service detailView</h3>
    @include('admin.service.back')
</div>
<form class="form-horizontal"   enctype="multipart/form-data">
                      @csrf
                      <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Name :</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="name" value="{{$data->name}}"  name="name"  readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label">Description :</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="description"  value="{{$data->description}}"  name="description"  readonly>
                       </div>
                      </div>
                      <div class="form-group row">
                        <label for="service_image" class="col-sm-3 col-form-label">Service Category Image :</label>
                        <div class="col-sm-8">
                        <img src="{{URL::to('/')}}/profile_image/{{$data->service_image}}">
                          <input type="text" class="form-control" value="{{$data->service_image}}"  id="service_image" name="service_image"  readonly>
                          </div>
                      </div>  
                      <div class="form-group row">
                        <label for="price_per_hour" class="col-sm-3 col-form-label">Price per hour :</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="price_per_hour" value="{{$data->price_per_hour}}"  name="price_per_hour"  readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="price_per_day" class="col-sm-3 col-form-label">Price per day :</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="price_per_day" value="{{$data->price_per_day}}"  name="price_per_day"  readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="price_per_month" class="col-sm-3 col-form-label">Price per month :</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="price_per_month" value="{{$data->price_per_month}}"  name="price_per_month"  readonly>
                        </div>
                      </div>                  
                    </form>
</div>
@endsection