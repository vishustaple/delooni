@extends('admin.layout.template')
@section('contents')
<div class="card" id ="test">
    <div class="card-header">
    <h3 class="card-title">Subscription</h3>
</div>
<form class="form-horizontal">
                      @csrf
                    <div class="form-group row">
                        <label for="plan_name" class="col-sm-3 col-form-label">Plan name :</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="plan_name" name="plan_name" value="{{$content->plan_name}}" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label">Description :</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="description" name="description" value="{{$content->description}}" readonly>
                        </div>
                      </div>
                 <div class="form-group row">
                        <label for="validity" class="col-sm-3 col-form-label">Plan validity :</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="validity" name="validity" value="{{$content->validity}}" readonly>
                        </div>
                      </div>  
                      <div class="form-group row">
                        <label for="price_per_plan" class="col-sm-3 col-form-label">Price per plan :</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="price_per_plan" name="price_per_plan" value="{{$content->price_per_plan}}" readonly>
                        </div>
                      </div> 
                   </form>
</div>
@endsection