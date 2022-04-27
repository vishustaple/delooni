@extends('admin.layout.template')
@section('contents')
<div class="card" id ="test">
    <div class="card-header yellow-bg">
    <h3 class="card-title">Terms and Condition</h3>
</div>
<div class="card-body">
<form class="form-horizontal">
                      @csrf
                   <div class="form-group row">
                        <!-- <label for="terms_and_condition" class="col-sm-12 col-form-label">Terms and Conditions</label> -->
                        <div class="col-sm-12">
                        <textarea rows="5" cols="85" name="terms_and_condition" id="terms_and_condition" readonly class="form-control">
                        {{$condition->terms_and_condition}}</textarea>
                        </div>
                        </div>
                    <div class="form-group row">
                      </div>
                    </form>
</div>
</div>
@endsection