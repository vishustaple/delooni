@extends('admin.layout.template')
@section('contents')
<div class="card" id = "test">
    <div class="card-header yellow-bg">
      <div class="row align-items-center">
        <div class="col-md-6">
          <h3 class="card-title">Rating Detail View</h3>
        </div>
    @include('admin.rating.back')
  </div>
</div>
<div class="card-body">
<form class="form-horizontal"   enctype="multipart/form-data">
      @csrf
      <div class="form-group row">
        <label for="user_id" class="col-sm-12 col-form-label">Provider name</label>
        <div class="col-sm-12">
          <input type="text" class="form-control" id="user_id" value="{{$data->user->first_name}}"  name="user_id"  readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="user_id" class="col-sm-12 col-form-label">Customer name</label>
        <div class="col-sm-12">
          <input type="text" class="form-control" id="user_id" value="{{$data->fromuser->first_name}}"  name="user_id"  readonly>
        </div>
      </div>
  
      <div class="form-group row">
        <label for="reporting_issue" class="col-sm-12 col-form-label">Rating</label>
        <div class="col-sm-12">
          <input type="text" class="form-control" id="reporting_issue" value="{{$data->rating}}"  name="reporting_issue"  readonly>
        </div>
      </div>       
      <div class="form-group row">
        <label for="message" class="col-sm-12 col-form-label">Message</label>
        <div class="col-sm-12">
          <textarea class="form-control" id="message"  name="message"  readonly>{{$data->message}}</textarea>
        </div>
      </div>             
    </form>
</div>
</div>
@endsection