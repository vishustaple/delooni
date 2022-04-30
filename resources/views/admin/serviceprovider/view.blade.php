<div class="card border-0 shadow-none">
  <div class="card-header px-0">
    <h3 class="card-title font-weight-bold">Service Provider List</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body p-0 border-0">
    <div class="table-responsive table-bordered">
    <table class="table">
      @if(count($data)>0)
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <!-- <th>ID</th> -->
          <th>Name</th>
          <th>Email</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      @endif
      <tbody>
        @forelse($data as $key=>$value)

        <tr>
          <td>{{$key+1}}</td>
          <!-- <td>{{$value->id}}</td> -->
          <td>{{$value->first_name}}</td>
          <td>{{$value->email}}</td>
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
          <h3> No Service Provider Availabale </h3>
        </center>
        @endforelse
      </tbody>
    </table>
   </div>
  </div>
  {{$data->links()}}

  <!-- /.card-body -->
</div>
<!-- /.card -->
<!-- <script>
  $(document).on('click', '.update', function(event) {

    $('#page-loader').show();

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var id = $(this).attr('data-id');
    $.ajax({
      url: '{{route("user.updateuser")}}',
      type: 'get',
      dataType: "html",
      data: {
        id: id
      },
      success: function(data) {
        $(".modal-backdrop").removeClass('modal-backdrop show');
        $('.updatemodaluser').html(data);
        $('#page-loader').hide();

      },
      error: function(error) {
        console.log(error.responseText);
        $('#page-loader').hide();
      }
    });
  }); -->

<!-- </script> -->