@extends('admin.layout.template')
@section('contents')
<div class="card" id = "test">
    <div class="card-header yellow-bg">
      <div class="row align-items-center">
        <div class="col-md-6">
          <h3 class="card-title">Query Detail View</h3>
        </div>
    @include('admin.query.back')
  </div>
</div>
<div class="card-body">
<form class="form-horizontal"   enctype="multipart/form-data">
      @csrf
      <div class="form-group row">
        <label for="user_id" class="col-sm-12 col-form-label">Customer name</label>
        <div class="col-sm-12">
          <input type="text" class="form-control" id="user_id" value="{{$data->user_id}}"  name="user_id"  readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="service_category_id" class="col-sm-12 col-form-label">Service Category name</label>
        <div class="col-sm-12">
          <input type="text" class="form-control" value="{{$data->service_category_id}}"  id="service_category_id" name="service_category_id"  readonly>
          </div>
      </div>  
    <div class="form-group row">
        <label for="subject" class="col-sm-3 col-form-label">Subject</label>
        <div class="col-sm-12">
          <input type="text" class="form-control" id="subject" value="{{$data->subject}}"  name="subject"  readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="reporting_issue" class="col-sm-12 col-form-label">Issue</label>
        <div class="col-sm-12">
          <input type="text" class="form-control" id="reporting_issue" value="{{$data->reporting_issue}}"  name="reporting_issue"  readonly>
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