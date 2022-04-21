@extends('admin.layout.template')
@section('contents')
<div class="card" id ="test">
    <div class="card-header">
    <h3 class="card-title">Static Content</h3>
</div>
<form class="form-horizontal"  id="content_update"  method="post"  enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="id" id="id" value="{{$content->id}}">
                      <div class="form-group row">
                        <label for="terms_and_condition" class="col-sm-3 col-form-label">Terms and Condition :</label>
                        <div class="col-sm-8">
                        <textarea rows="9" cols="55" name="terms_and_condition" id="terms_and_condition" readonly>{{$content->terms_and_condition}}
                       </textarea>
                        </div>
                        </div>
                       <div class="form-group row">
                        <label for="screen_baner_image" class="col-sm-3 col-form-label">Screen Baner Image :</label>
                       <div class="col-sm-8">
                       <img src="{{URL::to('/')}}/profile_image/{{$content->screen_baner_image}}">
                         </div>
                      </div>  
  </form>
</div>
  @endsection