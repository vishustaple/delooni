<div class="modal " id="myModal1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body updatemodaluser">

      </div>

    </div>
  </div>
</div>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Permissions</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>Name</th>
          <th>Action</th>
          <!-- <th style="width: 40px">Label</th> -->
        </tr>
      </thead>
      <tbody>
        <?php $i = 0 ?>
        @foreach($permissions as $permission)
        <tr>
          <td><?php $i++;
              echo $i; ?> </td>
          <td>{{$permission->name}}</td>
          <td>
            <button data-id="{{$permission->id}}" style="cursor:pointer" data-toggle="modal" data-target="#myModal1" class="btn btn-outline-success btn-sm rounded-pill update" id="updateUserRegister">Update</button>


            <a href="{{route('permissions.destroy',$permission->id)}}" class="btn btn-outline-danger btn-sm rounded-pill" onclick="event.preventDefault(); document.getElementById('submit-form').submit();">Delete</a>
          </td>
          <form id="submit-form" action="{{route('permissions.destroy',$permission->id)}}" method="POST" class="hidden">
    @csrf

    @method('DELETE')
</form>
        </tr>
        @endforeach

      </tbody>
    </table>
  </div>

  <!-- /.card-body -->
</div>
<!-- /.card -->
<script>
  $(document).on('click', '.update', function(event) {

    $('#page-loader').show();

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var id = $(this).attr('data-id');
    $.ajax({
      url : "/permissions/"+id+"/edit",
      type: 'get',
      dataType: "html",
      success: function(data) {
        $(".modal-backdrop").removeClass('modal-backdrop show');
        $('.updatemodaluser').html(data);
        $('#page-loader').hide();

      },
      error: function(error) {
        $('#page-loader').hide();
      }
    });
  });
</script>