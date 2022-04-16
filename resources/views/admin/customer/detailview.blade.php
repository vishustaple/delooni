@extends('admin.layout.template')
@section('contents')
<div class="card">
    <div class="card-header">
    <h3 class="card-title">Customer detailView</h3>
    @include('admin.customer.back')
</div>
<form class="form-horizontal">
                      @csrf
                      <div class="form-group row">
                        <label for="first_name" class="col-sm-3 col-form-label">First Name :</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" name="first_name" value="{{$data->first_name}}" readonly>
                         </div>
                      </div>
                      <div class="form-group row">
                        <label for="last_name" class="col-sm-3 col-form-label">Last Name :</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" name="last_name" value="{{$data->last_name}}" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email :</label>
                        <div class="col-sm-8">
                          <input type="email" class="form-control"  name="email" value="{{$data->email}}" readonly>
                         </div>
                      </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-3 col-form-label">Phone :</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control"  name="phone" value="{{$data->phone}}" readonly>
                         </div>
                      </div>    
                      <div class="form-group row">
                        <label for="address" class="col-sm-3 col-form-label">Address :</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control"  name="address" value="{{$data->address}}" readonly>
                     </div>
                      </div>    
                      <div class="form-group row">
                        <label for="nationality" class="col-sm-3 col-form-label">Nationality :</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control"  name="nationality" value="{{$data->nationality}}" readonly>
                         </div>
                      </div>           
                    </form>
</div>
</div>
@endsection