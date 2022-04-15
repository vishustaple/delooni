<div class="card" id ="test">
    <div class="card-header">
    <h3 class="card-title">Service List</h3>
</div>
<!-- /.card-header -->
 <div class="card-body" >
    <table class="table table-bordered">
    @if(count($data)>0)
    <thead>
    <tr>
    <th style="width: 10px">S.no.</th>
   <th>Service Name</th>
    <th>Description</th>
    <th>Service image</th>
    <th>Price (In/hour)</th>
    <th>Price (In/day)</th>
    <th>Price (In/month)</th>
    <th>Service category</th>
    <th>Status</th>
    <th>Action</th>
    </tr>
    </thead>
    @endif
    <tbody>
    @forelse($data as $key=>$value)
    <tr>
    <td>{{$key+1}}</td>
    <td>{{$value->name}}</td>
    <td>{{$value->description}}</td>
    <td>{{$value->service_image}}</td>
    <td>{{$value->price_per_hour}}</td>
    <td>{{$value->price_per_day}}</td>
    <td>{{$value->price_per_month}}</td>
    <td>{{$value->category_name}}</td>
    <td>@if($value->status==1)
    <button data-id="{{$value->id}}" class="disable_enable btn btn-success btn-xs" onclick="toggleDisableEnable(this)">Activate</button>
    @else
    <button data-id="{{$value->id}}" class="disable_enable btn btn-danger btn-xs" onclick="toggleDisableEnable(this)">Deactivate</button>
    @endif
    </td>
    <td>
    <a href='{{route("service.view", $value->id)}}'   target="_blank" class="btn btn-outline-success btn-xs view">View</a>
    <button data-id="{{$value->id}}" style="cursor:pointer" data-toggle="modal" data-target="#myModal1" class="btn btn-outline-success btn-xs update" class="viewjob_update">Update</button>
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
    <div class="modal-body viewJob_update">
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
<div id="num"  data-page="{{$data->currentPage()}}">    
 {{$data->links()}} 
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->