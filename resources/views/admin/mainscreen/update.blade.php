<form class="form-horizontal"  id="update_screen"  method="post"  enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id" value="{{$screenData->id}}"> 
    <div class="form-group row">
      <label for="title" class="col-sm-12 col-form-label">Screen Title</label>
    
      <div class="col-sm-12">
        <input type="text" class="form-control" id="title" name="title" value="{{$screenData->title}}">
        <div class="error" id="error_title">
        </div>
      </div>
    </div>
    <div class="form-group row uploadimage">
      <label class="col-sm-12 col-form-label">Service Category Image</label>
      <div class="col-sm-12">
      <img src="{{URL::to('/')}}/profile_image/{{$screenData->screen_image}}">
        <input type="file" class="form-control" id="screen_image" name="screen_image" value="{{$screenData->screen_image}}">
        <div class="error" id="error_screen_image">
        </div>
      </div>
    </div>  
    <div class="form-group row">
      <label for="description" class="col-sm-12 col-form-label">Description</label>
      <div class="col-sm-12">
        <textarea type="text" class="form-control" id="description" name="description" placeholder="Add Description">{{$screenData->description}}</textarea>
        <div class="error" id="error_description">
        </div>
      </div>
    </div>                  
    <div class="form-group row">
      <div class="col-sm-12 text-center">
        <button type="submit" class="btn app-button">Submit</button>
       
      </div>
    </div>
  </form>
