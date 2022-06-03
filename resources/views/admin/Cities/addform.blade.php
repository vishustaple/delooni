
         <form class="form-horizontal" action="" id="createCity" method="post">
                      @csrf
                      
                      <div class="form-group row">
                      <label for="countries" class="col-sm-12 col-form-label">Country</label>
                      <div class="col-sm-12 mb-2">
                      <div class="form-control select-wrapper">
                      <select class="form-control select2 " id="countries" name="countries">
                      <option value="N/A" disabled selected="true">--Select Country--</option>
                      @foreach($getcountry as $getcountries)
                      <option class="form-drop-items" value="{{$getcountries->id}}" data-iconurl="{{URL::to('/')}}/flag/{{$getcountries->flag}}">{{$getcountries->country_name}}</option>
                      @endforeach
                      </select>
                      <div class="error" id="error_countries">
                      </div>
                      </div>
                      
                       </div>
                     
                      </div>
                     
                      <div class="form-group row">
                        <label for="city_name" class="col-sm-12 col-form-label">City Name</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="city_name" name="city_name" placeholder="Enter City Name ">
                          <div class="error" id="error_city_name">
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="latitude" class="col-sm-12 col-form-label">Latitude</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Enter Latitude">
                          <div class="error" id="error_latitude">
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="longitude" class="col-sm-12 col-form-label">Longitude</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Enter Longitude">
                          <div class="error" id="error_longitude">

                          </div>
                        </div>
                      </div>   
                      <div class="form-group row">
                        <label for="radius" class="col-sm-12 col-form-label">Radius</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="radius" name="radius" placeholder="Enter Radius">
                          <div class="error" id="error_radius">

                          </div>
                        </div>
                      </div>                    
                      <div class="form-group row">
                        <div class="mx-auto col-sm-12  text-center">
                          <button type="submit" class="btn app-button">Submit</button>
                          <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                      </div>
                    </form>
