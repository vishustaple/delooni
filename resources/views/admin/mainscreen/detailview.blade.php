@extends('admin.layout.template')
@section('contents')
<div class="card" id ="test">
    <div class="card-header yellow-bg">
    <h3 class="card-title">Main Screen</h3>
</div>

<div class="card-body">
<form class="form-horizontal"  id="content_update"  method="post"  enctype="multipart/form-data">
                      @csrf
                      <div class="form-group row">
                        <label for="title" class="col-sm-12 col-form-label">Screen Title</label>
                      
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="title" name="title" value="{{$screen->title}}" readonly>
                        </div>
                      </div>
                     <div class="form-group row">
                      <label for="description" class="col-sm-12 col-form-label">Description</label>
                        <div class="col-sm-12">
                        <textarea class="form-control" rows="3" cols="55" name="description" id="description" readonly>{{$screen->description}}
                       </textarea>
                        </div>
                        </div>
                        <div class="form-group row">
                        <label for="screen_image" class="col-sm-12 col-form-label">Service Category Image</label>
                        <div class="col-sm-12">
                        <img src="{{URL::to('/')}}/profile_image/{{$screen->screen_image}}">
                        </div>
                      </div>  
  </form>
</div>
</div>
  @endsection