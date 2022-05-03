  <form class="form-horizontal"  id="add_category"  method="post"  enctype="multipart/form-data">
                      @csrf
                      <div class="form-group row">
                        <label for="name" class="col-sm-12 col-form-label">Name</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category Name">
                          <div class="error" id="error_name">
                         </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="description" class="col-sm-12 col-form-label">Description </label>
                        <div class="col-sm-12">
                          <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter Description"></textarea>
                          <div class="error" id="error_description">
                          </div>
                        </div>
                      </div>                       
                      <div class="form-group row">
                        <label for="screen_baner_image" class="col-sm-12 col-form-label">Screen Baner Image</label>
                        <div class="col-sm-12">
                          <input type="file" class="form-control" id="screen_baner_image" name="screen_baner_image" placeholder="Upload Screen Baner Image">
                          <div class="error" id="error_screen_baner_image">
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