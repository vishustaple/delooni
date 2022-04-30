<form class="form-horizontal"  id="update_category"  method="post"  enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="id"  id="id"  value="{{$categoryData->id}}"> 
                      <div class="form-group row">
                        <label for="name" class="col-sm-12 col-form-label">Name</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="name" value="{{$categoryData->name}}"  name="name">
                          <div class="error" id="error_name">
                         </div>
                        </div>
                      </div>
                      @if($categoryData->is_parent==0)
                      <div class="form-group row">
                        <label for="description" class="col-sm-12 col-form-label">Description</label>
                        <div class="col-sm-12">
                          <textarea class="form-control" id="description"  name="description">{{$categoryData->description}}</textarea>
                          <div class="error" id="error_description">
                          </div>
                        </div>
                      </div>
                      @else
                      @endif
                    <label  class="col-sm-12 col-form-label">Uploaded image</label>
                        <div class="col-sm-12">
                          <img src="{{URL::to('/')}}/profile_image/{{$categoryData->service_category_image}}">
                          <input type="file" class="form-control" id="service_category_image" name="service_category_image" accept="image/*">
                         <div class="error" id="error_service_category_image"></div>
                        </div>
                      </div>
</div>
                   <div class="form-group row mb-0">
                        <div class="col-sm-12 text-center">
                          <button type="submit" class="btn app-button">Submit</button>
                          <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                      </div>
                    </form>