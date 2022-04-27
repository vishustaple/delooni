@extends('admin.layout.template')
@section('contents')
<div class="card" id ="test">
    <div class="card-header">
    <h3 class="card-title">Terms and Condition</h3>
</div>
<form class="form-horizontal">
                      @csrf
                   <div class="form-group row">
                        <label for="terms_and_condition" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-8">
                        <textarea rows="25" cols="85" name="terms_and_condition" id="terms_and_condition" readonly>
                        {{$condition->terms_and_condition}}</textarea>
                        </div>
                        </div>
                    <div class="form-group row">
                      </div>
                    </form>
</div>
@endsection