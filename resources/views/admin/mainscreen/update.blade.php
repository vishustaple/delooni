<form class="form-horizontal"  id="update_screen"  method="post"  enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="id" id="id" value="{{$screenData->id}}"> 
                      <div class="form-group row">
                        <label for="title" class="col-sm-3 col-form-label">Screen Title :</label>
                      
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="title" name="title" value="{{$screenData->title}}">
                          <div class="error" id="error_title">
                         </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="screen_image" class="col-sm-3 col-form-label">Screen Image</label>
                        <div class="col-sm-8">
                          <img src="{{URL::to('/')}}/profile_image/{{$screenData->screen_image}}">
                          <input type="file" class="form-control" id="screen_image" name="screen_image" accept="image/*">
                         <div class="error" id="error_screen_image"></div>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label">Description :</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="description" name="description" value="{{$screenData->description}}">
                          <div class="error" id="error_description">
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