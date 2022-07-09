@extends('admin.layout.template')
@section('contents')
<div class="card">
    <div class="card-header yellow-bg">
      <div class="row align-items-center">
        <div class="col-md-6">
        <h3 class="card-title">Customer Detail View</h3>
      </div>
        @include('admin.customer.back')
 </div>
</div>
<div class="card-body">
<form class="form-horizontal">
    @csrf
    <div class="form-group row">
      <label for="first_name" class="col-sm-12 col-form-label">First Name</label>
      <div class="col-sm-12">
        <input type="text" class="form-control" name="first_name" value="{{$data->first_name}}" readonly>
        </div>
    </div>
    <div class="form-group row">
      <label for="last_name" class="col-sm-12 col-form-label">Last Name</label>
      <div class="col-sm-12">
        <input type="text" class="form-control" name="last_name" value="{{$data->last_name}}" readonly>
      </div>
    </div>
    <div class="form-group row">
      <label for="email" class="col-sm-12 col-form-label">Email</label>
      <div class="col-sm-12">
        <input type="email" class="form-control"  name="email" value="{{$data->email}}" readonly>
        </div>
    </div>
  <div class="form-group row">
      <label for="phone" class="col-sm-12 col-form-label">Phone</label>
      <div class="col-sm-12">
        <input type="text" class="form-control"  name="phone" value="{{$data->country_code}}{{$data->phone}}" readonly>
        </div>
    </div>    
    <div class="form-group row">
      <label for="address" class="col-sm-12 col-form-label">Address</label>
      <div class="col-sm-12">
        <textarea type="text" class="form-control"  name="address" readonly>{{$data->address}}</textarea>
    </div>
    </div>    
    <div class="form-group row">
      <label for="dateofbirth" class="col-sm-12 col-form-label">Date Of Birth</label>
      <div class="col-sm-12">
        <input type="text" class="form-control"  name="dateofbirth" readonly value="{{$data->dob}}">
    </div>
    </div>   
    <div class="form-group row">
      <label for="nationality" class="col-sm-12 col-form-label">Nationality</label>
      <div class="col-sm-12">
        <input type="text" class="form-control"  name="nationality" value="{{$data->nationality}}" readonly>
        </div>
    </div>           
  </form>
</div>
</div>
</div>
@endsection