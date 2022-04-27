<form class="form-horizontal"  id="content_update"  method="post"  enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="id" id="id" value="{{$content->id}}">
                      <div class="form-group row">
                        <label for="terms_and_condition" class="col-sm-12 col-form-label">Terms and Condition</label>
                        <div class="col-sm-12">
                        <textarea class="form-control" rows="3" cols="30" name="terms_and_condition" id="terms_and_condition">
                        {{$content->terms_and_condition}}</textarea>
                        <div class="error" id="error_terms_and_condition">
                         </div>
                         </div>
                        </div>
                       <div class="form-group row uploadimage">
                        <label for="screen_baner_image" class="col-sm-12 col-form-label">Screen Baner Image</label>
                       <div class="col-sm-12">
                       <img src="{{URL::to('/')}}/profile_image/{{$content->screen_baner_image}}">
                        <input type="file" class="form-control" id="screen_baner_image" name="screen_baner_image" accept="image/*">
                          <div class="error" id="error_screen_baner_image">
                         </div>
                        </div>
                      </div>  
                   <div class="form-group row">
                        <div class="col-sm-12 text-center">
                          <button type="submit" class="btn btn-success">Submit</button>
                          <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                      </div>
                    </form>