   <div class="card" id ="test">
    <div class="card-header">
    <h3 class="card-title">Splash screen</h3>
</div>
<!-- /.card-header -->
 <div class="card-body" >
    <table class="table table-bordered">
    @if(count($datas)>0)
    <thead>
    <tr>
    <th style="width: 10px">S.no.</th>
    <th>Screen Title</th>
    <th>Screen Image</th>
    <th>Screen Content</th>
    <th>Action</th>
    </tr>
    </thead>
    @endif
    <tbody>
    @forelse($datas as $key=>$value)
     <tr>
    <td>{{$key+1}}</td>
    <td>{{$value->title}}</td>
    <td>
  <img src="{{URL::to('/')}}/profile_image/{{$value->screen_image}}" width="100px" height="100px">
    </td>
    <td>{{$value->description}}</td>
    <td>
    <button data-id="{{$value->id}}" style="cursor:pointer" data-toggle="modal" data-target="#myModal1" class="btn btn-outline-success btn-xs update" class="viewJob_update">Update</button>
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
<a href='{{route("screen.view", $value->id)}}'   target="_blank" class="btn btn-outline-success btn-xs view">View</a>
    </td>
    </tr>
    @empty
    <center>
    <h3> Screen not Available </h3>
    </center>
    @endforelse
</tbody>
</table>
</div>
<div id="num"  data-page="{{$datas->currentPage()}}">    
 {{$datas->links()}} 
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->
