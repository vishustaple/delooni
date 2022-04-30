<form class="form-horizontal"  id="add_static_content"  method="post"  enctype="multipart/form-data">
                      @csrf
                    
                       <div class="form-group row">
                        <label  class="col-sm-12 col-form-label">Screen Banner Image</label>
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

                    
           