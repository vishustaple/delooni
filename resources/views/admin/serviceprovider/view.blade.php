<div class="card border-0 shadow-none">
  <div class="card-header px-0 border-0">
    <h3 class="card-title font-weight-bold">Service Provider List</h3>
  </div>
   <!--date range service provider-->
    <form method="POST" id="get_info_provider">
        @csrf
        <div class="input-group mb-3">
          <div class="row w-100">
            <div class="col-md-5">
            <input  class="form-control datepicker" name="start_date" placeholder="YYYY/MM/DD" autocomplete="off">
            <div class="error" id="error_start_date"></div>
            </div>
            <div class="col-md-5">
            <input class="form-control datepicker" name="end_date" placeholder="YYYY/MM/DD" autocomplete="off">
            <div class="error" id="error_end_date"></div>
            </div>
            <div class="col-md-2">
            <button class="btn yellow-bg w-100" type="submit">Filter</button>
            </div>
        </div>
      </div>
    </form>
  <!-- /.card-header -->
  <div class="card-body p-0 border-0 mt-2" id="provider">
    <div class="table-responsive ">
    <table class="table table-bordered">
      @if(count($data)>0)
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <!-- <th>ID</th> -->
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      @endif
      <tbody>
        @forelse($data as $key=>$value)

        <tr>
          <td>{{$key+$data->firstItem()}}</td>
          <!-- <td>{{$value->id}}</td> -->
          <td>{{$value->first_name}} {{$value->last_name}}</td>
          <td>{{$value->email}}</td>
          <td>{{$value->country_code}}{{$value->phone}}</td>
          <td>@if($value->status==1)
            <button data-id="{{$value->id}}" class="disable_enable btn btn-success btn-xs" onclick="toggleDisableEnable(this)">Enable</button>
            @else
            <button data-id="{{$value->id}}" class="disable_enable btn btn-danger btn-xs" onclick="toggleDisableEnable(this)">Disable</button>
            @endif
          </td>
          <td>
            <a href="{{route('provider.viewdata',$value->id)}}" target="_blank" class="btn btn-outline-dark btn-xs view">View</a>
            <!-- <a class="btn btn-outline-success btn-xs update" style="cursor:pointer;" id="updateserviceprovider" >Update</a> -->
            <button style="cursor:pointer"  class="btn btn-outline-dark btn-xs updateserviceprovider" data-userid="{{$value->id}}" >Update</button>
          
            <button data-id="{{$value->id}}" class="btn btn-danger btn-xs remove">Remove</button>
          </td>
        </tr>
        @empty
        <center>
        <h5 class="border p-2"> No Service Provider Availabale </h5>
        </center>
        @endforelse
      </tbody>
    </table>
   </div>
   <div class="mt-3">
    {{$data->links()}}
  </div>
  </div>

  <!-- /.card-body -->
</div>
<!-- /.card -->


<script>
      $(document).on('change','#phone',function(){
      var countryCode = $('#phoneC .iti__selected-flag').attr('title');
      var countryCode=countryCode.split(':');
      var countryCode = countryCode[1];
      $("#country_code").val(countryCode);
        });
//datepicker function 
    $( function() {
    $( ".datepicker" ).datepicker({
      format:'yy-mm-dd',
      todayHighlight: true,
      endDate: "today",

    });
} ); 
</script>