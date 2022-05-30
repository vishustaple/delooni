<div class="card">
              <!-- <div class="card-header">
                <h3 class="card-title">UpdateCity</h3>
                @include('admin.Cities.back')
              </div> -->
              <!-- /.card-header -->
             
             <div class="card-body" id="updateCity">
             <form class="form-horizontal" action="{{url('/')}}/admin/city/updatecitydata" id="update_city" method="post">
                      @csrf
                      <input type="hidden" name="id" id="id" value="{{$data->id}}">
                      <div class="form-group row">
                      <label for="countries" class="col-sm-2 col-form-label">Country</label>
                      <div class="col-sm-10">
                     
                      <select class="form-control select2 " id="countries" name="countries">
                      <option value="N/A" disabled selected="true">--Select Country--</option>
                      @foreach($city as $getcountries)
                      <option class="form-drop-items" {{  ($data->country_id) == $getcountries->id ? 'selected' : '' }} value="{{$getcountries->id}}" data-iconurl="{{URL::to('/')}}/flag/{{$getcountries->flag}}">{{$getcountries->country_name}}</option>
                      @endforeach
                      </select>
                      <div class="error" id="error_countries">
                      </div>
                       </div>
                      </div>

                      <div class="form-group row">
                        <label for="city_name" class="col-sm-2 col-form-label">City Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="city_name" name="city_name" value="{{$data->city_name}}">
                          <div class="error" id="error_city_name">
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="latitude" class="col-sm-2 col-form-label">Latitude</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="latitude" name="latitude" value="{{$data->latitude}}">
                          <div class="error" id="error_latitude">
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="longitude" class="col-sm-2 col-form-label">Longitude</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="longitude" name="longitude" value="{{$data->longitude}}">
                          <div class="error" id="error_longitude">

                          </div>
                        </div>
                      </div>   
                      <div class="form-group row">
                        <label for="radius" class="col-sm-2 col-form-label">Radius</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="radius" name="radius" value="{{$data->radius}}">
                          <div class="error" id="error_radius">

                          </div>
                        </div>
                      </div>                    
                     
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-success">Update</button>
                          <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                      </div>
                </form>
                </div>
</div>
