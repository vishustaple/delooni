<form class="form-horizontal"  id="update_service"  method="post"  enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" class="form-control" id="id" name="id" value="{{$categoryData->id}}">
                      <div class="form-group row">
                        <label for="name" class="col-sm-12 col-form-label">Service Name </label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="title" name="title" value="{{$categoryData->title}}">
                          <div class="error" id="_error_title">
                         </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="price_per_hour" class="col-sm-12 col-form-label">Price Per Hour</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="price_per_hour" name="price_per_hour" value="{{$categoryData->price_per_hour}}" placeholder="Price Per Month">
                          <div class="error" id="_error_price_per_hour">
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="price_per_day" class="col-sm-12 col-form-label">Price Per Day</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="price_per_day" name="price_per_day" value="{{$categoryData->price_per_day}}" placeholder="Price Per Day">
                          <div class="error" id="_error_price_per_day">
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="price_per_month" class="col-sm-12 col-form-label">Price Per Month</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="price_per_month" name="price_per_month" value="{{$categoryData->price_per_month}}" placeholder="Price Per Month">
                          <div class="error" id="_error_price_per_month">
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="description" class="col-sm-12 col-form-label">Description</label>
                        <div class="col-sm-12">
                        <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter Description">{{$categoryData->description}}</textarea>
                          <div class="error" id="_error_description">
                          </div>
                        </div>
                      </div>
                    <div class="form-group row uploadimage">
                        <label class="col-sm-12 col-form-label">Service Category Image </label>
                        <div class="col-sm-12">
                        <img class="lazyload" src="{{URL::to('/')}}/profile_image/{{$categoryData->service_image}}">
                          <input type="file" class="form-control" id="service_image" name="service_image" value="{{$categoryData->service_image}}">
                          <div class="error" id="_error_service_image">
                         </div>
                        </div>
                      </div>  
                    <div class="form-group row">
                        <label for="service_category_id" class="col-sm-12 col-form-label">Select category </label>
                        <div class="col-sm-12">
                        <select name="cat_id" id="cat_id" class="form-control select2" >
                          <option value="N/A" disabled selected="true">--Select category--</option>
                       @foreach($categorynames as $categoryname)
                       <option value="{{ $categoryname->id }}" {{ $categoryData->cat_id == $categoryname->id ? 'selected' : '' }}>{{ $categoryname->name }}</option>
                       @endforeach
                       </select>
                      </div>
                      </div> 
                      <div class="form-group row">
                        <label for="user_id" class="col-sm-12 col-form-label">Select serviceprovider :</label>
                        <div class="col-sm-12">
                        <select class="form-control select2" id="user_id" name="user_id">
                        <option value="N/A" disabled selected="true">--Select serviceprovider--</option>
                       @foreach($serviceproviders as $serviceprovider)
                      <option class="form-drop-items" value="{{$serviceprovider->id}}">{{$serviceprovider->first_name}}</option>
                        @endforeach
                       </select>
                        <div class="error" id="_error_user_id"></div>
                      </div>
                      </div>
                    <div class="form-group row">
                        <div class="col-sm-12 text-center">
                          <button type="submit" class="btn app-button">Submit</button>
                          <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                      </div>
                    </form>