<div class="card border-0 shadow-none" id ="test">
    <div class="card-header px-0">
    <h3 class="card-title font-weight-bold">Plan List</h3>
</div>
<!-- /.card-header -->
 <div class="card-body p-0 border-0" >
     <div class="table-responsive table-bordered">
    <table class="table">
    @if(count($data)>0)
    <thead>
    <tr>
    <th style="width: 10px">S.no.</th>
    <th>Plan Name</th>
    <th>Description</th>
    <th>Validity</th>
    <th>Price (per/plan)</th>
    <th>Status</th>
    <th>Action</th>
    </tr>
    </thead>
    @endif
    <tbody>
    @forelse($data as $key=>$value)
    <tr>
    <td>{{$key+1}}</td>
    <td>{{$value->plan_name}}</td>
    <td>{{$value->description}}</td>
    <td>{{$value->validity}}</td>
    <td>{{$value->price_per_plan}}</td>
   <td>@if($value->status==1)
    <button data-id="{{$value->id}}" class="disable_enable btn btn-success btn-xs" onclick="toggleDisableEnable(this)">Activate</button>
    @else
    <button data-id="{{$value->id}}" class="disable_enable btn btn-danger btn-xs" onclick="toggleDisableEnable(this)">Deactivate</button>
    @endif
    </td>
    <td>
    <a href='{{route("subscription.view", $value->id)}}'   target="_blank" class="btn btn-outline-success btn-xs view">View</a>
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
</div>
<div id="num"  data-page="{{$data->currentPage()}}">    
 {{$data->links()}} 
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->