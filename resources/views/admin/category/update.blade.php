<form class="form-horizontal"  id="update_category"  method="post"  enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="id"  id="id"  value="{{$categoryData->id}}"> 
                      <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Name :</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="name" value="{{$categoryData->name}}"  name="name">
                          <div class="error" id="error_name">
                         </div>
                        </div>
                      </div>
                      @if($categoryData->is_parent==0)
                      <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label">Description :</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="description"  value="{{$categoryData->description}}"  name="description">
                          <div class="error" id="error_description">
                          </div>
                        </div>
                      </div>
                      @else
                      @endif
                      <div class="form-group row">
                        <label for="service_category_image" class="col-sm-3 col-form-label">Category Image:</label>
                        <div class="col-sm-8">
                        <img src="{{URL::to('/')}}/profile_image/{{$categoryData->service_category_image}}">
                          <input type="file" class="form-control"  value="{{$categoryData->service_category_image}}" id="service_category_image" name="service_category_image">
                          <div class="error" id="error_service_category_image">
                          </div>
                        </div>
                      </div>
                   <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-success">Submit</button>
                          <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                      </div>
                    </form>