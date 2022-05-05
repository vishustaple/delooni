<div class="card shadow-none" id ="test">
    
<!-- /.card-header -->
 <div class="card-body p-0" >
     <div class="table-responsive table-bordered">
    <table class="table">
    @if(count($condition)>0)
    <thead>
    <tr>
    <th>Terms and condition</th>
     <th>Action</th>
    </tr>
    </thead>
    @endif
    <tbody>
    @forelse($condition as $key=>$value)
    <tr>
    
    <td>    <textarea class="form-control" rows="15" cols="80" name="terms_and_condition" id="terms_and_condition" readonly>
    {{$value->terms_and_condition}}</textarea></td>
   <td>

    <a href='{{route("condition.view", $value->id)}}'   target="_blank" class="btn btn-outline-dark btn-xs view">View</a>
    <button data-id="{{$value->id}}" style="cursor:pointer" data-toggle="modal" data-target="#myModal1" class="btn btn-outline-dark btn-xs update" class="viewjob_update">Update</button>
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
<!-- <button data-id="{{$value->id}}" class="btn btn-danger btn-xs remove">Remove</button> -->
    </td>
    </tr>
    @empty
    <center>
    <h5 class="p-3 border mb-0"> No condition </h5>
    </center>
    @endforelse
</tbody>
</table>
</div>
</div>

<!-- /.card-body -->
</div>
<!-- /.card -->