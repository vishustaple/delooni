<div class="card shadow-none border-0 p-0" id ="test">
    <div class="card-header px-0 ">
    <h3 class="card-title font-weight-bold">Service List</h3>
</div>
<!-- /.card-header -->
 <div class="card-body p-0 border-0">
 <div class="table-responsive table-bordered">
    <table class="table">
    @if(count($subcategory)>0)
    <thead>
    <tr>
    <th style="width: 10px">S.no.</th>
    <th>Service Name</th>
    <th>Description</th>
    <th>image</th>
    <th>Status</th>
    <th>Action</th>
    </tr>
    </thead>
    @endif
    <tbody>
    @forelse($subcategory as $key=>$value)
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
    <a href='{{route("subcategory.view", $value->id)}}'   target="_blank" class="btn btn-outline-dark btn-xs view">view</a>
    <button data-id="{{$value->id}}" style="cursor:pointer" data-toggle="modal" data-target="#myModal1" class="btn btn-outline-dark btn-xs update" class="viewjob_update">Update</button>
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
    <h5 class="border p-2"> Service not Available </h5>
    </center>
    @endforelse
</tbody>
</table>
</div>
</div>
<div id="num"  data-page="{{$subcategory->currentPage()}}">    
 {{$subcategory->links()}} 
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->