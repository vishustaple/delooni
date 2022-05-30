
@extends('admin.layout.template')
@section('contents')
<div id="users_data">
<div class="card">
              <div class="card-header">
                <h3 class="card-title">City</h3>
                @include('admin.Cities.back')
              </div>
              <!-- /.card-header -->
             <div class="card-body">
                     
             <div class="form-group row">
                        <label for="country_name" class="col-sm-2 col-form-label">Country Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="country_name" name="country_name" value="{{$city->country_name}}" readonly>
                          <div class="error" id="error_country_name">
                          </div>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="city_name" class="col-sm-2 col-form-label">City Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="city_name" name="city_name" value="{{$data->city_name}}" readonly>
                          <div class="error" id="error_city_name">
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="latitude" class="col-sm-2 col-form-label">Latitude</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="latitude" name="latitude" value="{{$data->latitude}}" readonly>
                          <div class="error" id="error_latitude">
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="longitude" class="col-sm-2 col-form-label">Longitude</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="longitude" name="longitude" value="{{$data->longitude}}" readonly>
                          <div class="error" id="error_longitude">

                          </div>
                        </div>
                      </div>   
                      <div class="form-group row">
                        <label for="radius" class="col-sm-2 col-form-label">Radius</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="radius" name="radius" value="{{$data->radius}}" readonly>
                          <div class="error" id="error_radius">

                          </div>
                        </div>
                      </div>        

                </div>
</div>

</div>
@endsection