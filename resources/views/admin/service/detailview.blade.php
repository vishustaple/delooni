@extends('admin.layout.template')
@section('contents')
<div class="card" id = "test">
    <div class="card-header yellow-bg">
      <div class="row align-items-center">
        <div class="col-md-6">
        <h3 class="card-title">Service Detail View</h3>
      </div>
    @include('admin.service.back')
 </div>
</div>
<div class="card-body">
<form class="form-horizontal"   enctype="multipart/form-data">
    @csrf
    <div class="form-group row">
      <label for="name" class="col-sm-12 col-form-label">Name </label>
      <div class="col-sm-12">
        <input type="text" class="form-control" id="name" value="{{$data->name}}"  name="name"  readonly>
      </div>
    </div>
    <div class="form-group row">
      <label for="description" class="col-sm-12 col-form-label">Description </label>
      <div class="col-sm-12">
        <textarea class="form-control" id="description"  name="description"  readonly>{{$data->description}}</textarea>
      </div>
    </div>
    <div class="form-group row uploadimage">
      <label for="service_image" class="col-sm-12 col-form-label">Service Category Image </label>
      <div class="col-sm-12">
      <img class="lazyload" src="{{URL::to('/')}}/profile_image/{{$data->service_image}}">
        <input type="text" class="form-control" value="{{$data->service_image}}"  id="service_image" name="service_image"  readonly>
        </div>
    </div>  
    <div class="form-group row">
      <label for="price_per_hour" class="col-sm-12 col-form-label">Price per hour </label>
      <div class="col-sm-12">
        <input type="text" class="form-control" id="price_per_hour" value="{{$data->price_per_hour}}"  name="price_per_hour"  readonly>
      </div>
    </div>
    <div class="form-group row">
      <label for="price_per_day" class="col-sm-12 col-form-label">Price per day </label>
      <div class="col-sm-12">
        <input type="text" class="form-control" id="price_per_day" value="{{$data->price_per_day}}"  name="price_per_day"  readonly>
      </div>
    </div>
    <div class="form-group row">
      <label for="price_per_month" class="col-sm-12 col-form-label">Price per month </label>
      <div class="col-sm-12">
        <input type="text" class="form-control" id="price_per_month" value="{{$data->price_per_month}}"  name="price_per_month"  readonly>
      </div>
    </div>                  
  </form>
</div>
</div>
@endsection