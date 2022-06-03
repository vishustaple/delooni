<div class="card">
  <div class="card-header">
    <h3 class="card-title">City List</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table class="table table-bordered">
      @if(count($data)>0)
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>City Name</th>
          <th>latitude</th>
          <th>longitude</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      @endif
      <tbody>
        @forelse($data as $key=>$value)

        <tr>
          <td>{{$key+1}}</td>
          <td>{{$value->city_name}}</td>
          <td>{{$value->latitude}}</td>
          <td>{{$value->longitude}}</td>
          <td>@if($value->status==1)
            <button data-id="{{$value->id}}" class="disable_enable btn btn-success btn-xs" onclick="toggleDisableEnable(this)">Enable</button>
            @else
            <button data-id="{{$value->id}}" class="disable_enable btn btn-danger btn-xs" onclick="toggleDisableEnable(this)">Disable</button>
            @endif
          </td>
          <td>
            <a href="{{route('city.viewData',$value->id)}}" target="_blank" class="btn btn-outline-dark btn-xs view">View</a>
            <button data-id="{{$value->id}}" style="cursor:pointer" data-toggle="modal" data-target="#myModal1" class="btn btn-outline-dark btn-xs update" id="updateCity">Update</button>
            <!-- The Modal -->
            <div class="modal " id="myModal1">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Update</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body updatemodalcity">

                  </div>

                </div>
              </div>
            </div>
            <button data-id="{{$value->id}}" class="btn btn-danger btn-xs remove">Remove</button>
          </td>
        </tr>
        @empty
        <center>
        <h5 class="border p-2"> No City Availabale </h5>
        </center>
        @endforelse
      </tbody>
    </table>
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
    console.log(id);
    $.ajax({
      url: '{{route("city.updatecity")}}',
      type: 'get',
      dataType: "html",
      data: {
        id: id
      },
      success: function(data) {
        $(".modal-backdrop").removeClass('modal-backdrop show');
        $('.updatemodalcity').html(data);
        $('#page-loader').hide();

      },
      error: function(error) {
        console.log(error.responseText);
        $('#page-loader').hide();
      }
    });
  });
</script> -->