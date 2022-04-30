<div class="card shadow-none border-0 p-0" id ="test">
    <div class="card-header px-0 ">
    <h3 class="card-title font-weight-bold">Category List</h3>
</div>
<!-- /.card-header -->
 <div class="card-body p-0 border-0">
 <div class="table-responsive table-bordered">
    <table class="table">
    @if(count($data)>0)
    <thead>
    <tr>
    <th style="width: 10px">S.no.</th>
    <th>Name</th>
    <th>Description</th>
    <th>image</th>
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
    <td>
    <img class="lazyload" src="{{URL::to('/')}}/profile_image/{{$value->service_category_image}}">
    </td>
    <td>@if($value->status==1)
    <button data-id="{{$value->id}}" class="disable_enable btn btn-success btn-xs" onclick="toggleDisableEnable(this)">Activate</button>
    @else
    <button data-id="{{$value->id}}" class="disable_enable btn btn-danger btn-xs" onclick="toggleDisableEnable(this)">Deactivate</button>
    @endif
    </td>
    <td>
    <a href='{{route("category.view", $value->id)}}'   target="_blank" class="btn btn-outline-success btn-xs view">Sub category</a>
    <button data-id="{{$value->id}}" style="cursor:pointer" data-toggle="modal" data-target="#myModal1" class="btn btn-outline-success btn-xs update" class="viewjob_update">Update</button>
    <!-- The Modal -->
    <div class="modal " id="myModal1">
    <div class="modal-dialog modal-md">
    <div class="modal-content">
   <!-- Modal Header -->
   <div class="modal-header">
    <h5 class="modal-title">Update</h5>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <!-- Modal body -->
    <div class="modal-body viewJob_update pt-0">
    </div>
</div>
</div>
</div>
<button data-id="{{$value->id}}" class="btn btn-danger btn-xs remove">Remove</button>
    </td>
    </tr>
    @empty
    <center>
    <h5 class="border p-2"> No User Available </h5>
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
  
       
      



















