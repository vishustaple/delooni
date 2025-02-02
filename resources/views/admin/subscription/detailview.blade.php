@extends('admin.layout.template')
@section('contents')
<div class="card" id ="test">
    <div class="card-header yellow-bg">

    <div class="row align-items-center">
      <div class="col-md-6">
        <h3 class="card-title mb-0">Subscription</h3>

      </div>

      <div class="col-md-6">
          @include('admin.subscription.back')
      </div>
    </div>
    
</div>
<div class="card-body">
<form class="form-horizontal">
                      @csrf
                     <div class="form-group row">
                        <label for="plan_name" class="col-sm-12 col-form-label">Plan name</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="plan_name" name="plan_name" value="{{$content->plan_name}}" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="description" class="col-sm-12 col-form-label">Description</label>
                        <div class="col-sm-12">
                          <textarea class="form-control" id="description" name="description" placeholder="Description" readonly>{{$content->description}}</textarea>
                        </div>
                        </div>
                      <div class="form-group row">
                        <label for="validity" class="col-sm-12 col-form-label">Plan validity</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="validity" name="validity" value="{{$content->validity}}" readonly>
                        </div>
                      </div>  
                      <div class="form-group row">
                        <label for="price_per_plan" class="col-sm-12 col-form-label">Price per plan</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="price_per_plan" name="price_per_plan" value="{{$content->price_per_plan}}" readonly>
                        </div>
                      </div> 
                      <div class="form-group row">
                        <label for="user_type" class="col-sm-12 col-form-label">User Type</label>
                        <div class="col-sm-12">
                        @foreach(App\Models\Subscription::getusertype() as $key => $val)
                        @if($key == $content->user_type)
                        <input type="text" class="form-control" id="user_type" name="user_type" value="{{$val}}" readonly>
                        @endif
                        @endforeach
                        </div>
                      </div> 
                      <div class="form-group row">
                        <label for="plan_type" class="col-sm-12 col-form-label">Plan Type</label>
                        <div class="col-sm-12">
                        @foreach(App\Models\Subscription::getplantype() as $key => $val)
                        @if($key == $content->plan_type)
                        <input type="text" class="form-control" id="plan_type" name="plan_type" value="{{$val}}" readonly>
                        @endif
                        @endforeach
                        </div>
                      </div> 
                   </form>
</div>
</div>
@endsection