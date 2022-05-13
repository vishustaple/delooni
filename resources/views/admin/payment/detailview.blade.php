@extends('admin.layout.template')
@section('contents')
<div class="card" id = "test">
    <div class="card-header yellow-bg">
      <div class="row align-items-center">
        <div class="col-md-6">
          <h3 class="card-title">Payment History Detail View</h3>
        </div>
    @include('admin.payment.back')
  </div>
</div>
<div class="card-body">
<form class="form-horizontal">
      @csrf
      <div class="form-group row">
        <label for="plan_id" class="col-sm-12 col-form-label">Plan name</label>
        <div class="col-sm-12">
          <input type="text" class="form-control" id="plan_id" value="{{$plan_name->plan_name}}"  name="plan_id"  readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="amount" class="col-sm-12 col-form-label">Amount</label>
        <div class="col-sm-12">
          <input type="text" class="form-control" value="{{$payment->amount}}"  id="amount" name="amount"  readonly>
          </div>
      </div>  
    <div class="form-group row">
        <label for="transaction_id" class="col-sm-3 col-form-label">Transaction number</label>
        <div class="col-sm-12">
          <input type="text" class="form-control" id="transaction_id" value="{{$payment->transaction_id}}"  name="transaction_id"  readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="payment_status" class="col-sm-12 col-form-label">Payment Status</label>
        <div class="col-sm-12">
          <input type="text" class="form-control" id="payment_status" value="{{$payment->payment_status}}"  name="payment_status"  readonly>
        </div>
      </div>       
      <div class="form-group row">
        <label for="created_by" class="col-sm-12 col-form-label">User</label>
        <div class="col-sm-12">
          <input type="text" class="form-control" id="created_by" value="{{$user_name->first_name}}"  name="created_by"  readonly>
        </div>
      </div>             
    </form>
</div>
</div>
@endsection