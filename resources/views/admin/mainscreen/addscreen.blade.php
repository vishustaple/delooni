<form class="form-horizontal"  id="add_image"  method="post"  enctype="multipart/form-data">
                      @csrf
                      <div class="form-group row">
                        <label for="title" class="col-sm-12  col-form-label">Screen Title </label>
                      
                        <div class="col-sm-12 ">
                          <input type="text" class="form-control" id="title" name="title" placeholder="Enter Screen title">
                          <div class="error" id="error_title">
                         </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="screen_image" class="col-sm-12  col-form-label">Service Category Image </label>
                        <div class="col-sm-12 ">
                          <input type="file" class="form-control" id="screen_image" name="screen_image" placeholder="Upload Screen Image">
                          <div class="error" id="error_screen_image">
                         </div>
                        </div>
                      </div>  
                      <div class="form-group row">
                        <label for="description" class="col-sm-12  col-form-label">Description </label>
                        <div class="col-sm-12 ">
                          <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter Screen Content"></textarea>
                          <div class="error" id="error_description">
                          </div>
                        </div>
                      </div>                  
                      <div class="form-group row">
                        <div class="col-sm-12 text-center">
                          <button type="submit" class="btn app-button">Submit</button>
                          <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                      </div>
                    </form>