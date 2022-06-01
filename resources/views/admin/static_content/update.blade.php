<form class="form-horizontal"  id="content_update"  method="post"  enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id" value="{{$content->id}}">
    <div class="form-group row uploadimage">
      <label class="col-sm-12 col-form-label">Screen Banner Image</label>
      <div class="col-sm-12">
      <img src="{{URL::to('/')}}/profile_image/{{$content->screen_baner_image}}">
      <input type="file" class="form-control" id="screen_baner_image" name="screen_baner_image" accept="image/*">
        <div class="error" id="error_screen_baner_image">
        </div>
      </div>
    </div>  
  <div class="form-group row">
      <div class="col-sm-12 text-center">
        <button type="submit" class="btn app-button">Submit</button>
      </div>
    </div>
  </form>
