
<div class="card border-0 shadow-none" id ="test">
   
        <form method="POST" id="get_info_payment">
            @csrf
            <div class="input-group mb-3">
                <div class="row w-100">
                <div class="col-md-5">
                <input class="form-control datepicker" name="start_date" placeholder="DD/MM/YYYY">
                <div class="error" id="error_start_date"></div>
                </div>
                <div class="col-md-5">
                <input class="form-control datepicker" name="end_date" placeholder="DD/MM/YYYY">
                <div class="error" id="error_end_date"></div>
                </div>
                <div class="col-md-2">
                <button class="btn yellow-bg w-100" type="submit">Filter</button>
                </div>
            </div>
            </div>
        </form>
    
    <!-- /.card-header -->
    <div class="card-body p-0 mt-2" id="info_payment">
        <div class="table-responsive table-bordered">
    <table class="table">
     @if(count($data)>0)
     <thead>
     <tr>
     <th style="width: 10px;">S.no.</th>
     <th>Plan name</th>
     <th>Amount</th>
     <th>Transaction number</th>
     <th>Payment status</th>
     <th>Users</th>
     <th>Payment Date</th>
      <th style="width:15%">Action</th>
     </tr>
     </thead>
     @endif
     <tbody>
     @forelse($data as $key=>$value)
     <tr>
     <td>{{$key+$data->firstItem()}}</td>
     <td>{{$value->getplanname->plan_name}}</td>
     <td>{{$value->amount}}</td>
     <td>{{$value->transaction_id}}</td>
     <td>{{$value->payment_status}}</td>
     <td>{{$value->users->first_name}}</td>
     <td>{{$value->created_at->format('d-m-Y h:m:s')}}</td>
     <td>
     <a href='{{route("payment.view", $value->id)}}'   target="_blank" class="btn btn-outline-dark btn-xs view">View</a>
     <!-- <button data-id="{{$value->id}}" class="btn btn-danger btn-xs remove">Remove</button> -->
     </td>
     </tr>
     @empty
     <h5 class="text-center p-2"> Payment History not available </h5>
     @endforelse
 </tbody>
 </table>
 </div>
 <div id="num"  data-page="{{$data->currentPage()}}">    
 <div class="mt-3"> 
  {{$data->links()}} 
 </div>
 </div>
</div>

 <!-- /.card-body -->
 </div>
 <!-- /.card -->
 <script>
    $( function() {
    $( ".datepicker" ).datepicker({
      format:'dd-mm-yy',
      todayHighlight: true,
    });
  } );
 </script>
 