@extends('admin.layout.template')
@section('contents')
<div class="card" id ="test">
    <div class="card-header yellow-bg">
    <h3 class="card-title">Static Content</h3>
</div>
<div class="card-body">
<form class="form-horizontal"  id="content_update"  method="post"  enctype="multipart/form-data">
                      @csrf
                      <div class="form-group row uploadimage">
                        <label for="screen_baner_image" class="col-sm-12 col-form-label">Screen Baner Image :</label>
                       <div class="col-sm-12">
                       <img src="{{URL::to('/')}}/profile_image/{{$content->screen_baner_image}}">
                         </div>
                      </div>  
  </form>
</div>
</div>
  @endsection