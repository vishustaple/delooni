<div class="card">
    <div class="card-header">
    <h3 class="card-title">Customers List</h3>
</div>
<!-- /.card-header -->
    <div class="card-body">
    <table class="table table-bordered">
    @if(count($data)>0)
    <thead>
    <tr>
    <th style="width: 10px">#</th>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Address</th>
    <th>Status</th>
    <th>Action</th>
    </tr>
    </thead>
    @endif
    <tbody>
    @forelse($data as $key=>$value)
    <tr>
    <td>{{$key+1}}</td>
    <td>{{$value->id}}</td>
    <td>{{$value->first_name}}</td>
    <td>{{$value->email}}</td>
    <td>{{$value->phone}}</td>
    <td>{{$value->address}}</td>
    <td>@if($value->status==1)
    <button data-id="{{$value->id}}" class="disable_enable btn btn-success btn-xs" onclick="toggleDisableEnable(this)">Enable</button>
    @else
    <button data-id="{{$value->id}}" class="disable_enable btn btn-danger btn-xs" onclick="toggleDisableEnable(this)">Disable</button>
    @endif
    </td>
    <td>
    <a href="" target="_blank" class="btn btn-outline-success btn-xs view">View</a>
    <button data-id="{{$value->id}}" style="cursor:pointer" data-toggle="modal" data-target="#myModal1" class="btn btn-outline-success btn-xs update" id="">Update</button>
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
    <div class="modal-body updatemodaluser">
    </div>

</div>
</div>
</div>
<button data-id="{{$value->id}}" class="btn btn-danger btn-xs remove">Remove</button>
    </td>
    </tr>
    @empty
    <center>
    <h3> No User Available </h3>
    </center>
    @endforelse
</tbody>
</table>
</div>
{{-- {{$data->links()}} --}}
<!-- /.card-body -->
</div>
<!-- /.card -->
  
       
      



















