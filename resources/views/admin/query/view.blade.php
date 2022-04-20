
<div class="card" id ="test">
    <div class="card-header">
    <h3 class="card-title">Query List</h3>
</div>
   <!-- /.card-header -->
   <div class="card-body">
   <table class="table table-bordered">
    @if(count($query)>0)
    <thead>
    <tr>
    <th style="width: 10px">S.no.</th>
    <th style="width: 10px">ID</th>
    <th>Customer name</th>
   <th>Service Category name</th>
    <th>Subject</th>
    <th>Issue</th>
    <th>Message</th>
     <th>Action</th>
    </tr>
    </thead>
    @endif
    <tbody>
    @forelse($query as $key=>$value)
    <tr>
    <td>{{$key+1}}</td>
    <td>{{$value->id}}</td>
    <td>{{$value->first_name}}</td>
    <td>{{$value->name}}</td>
     <td>{{$value->subject}}</td>
    <td>{{$value->reporting_issue}}</td>
    <td>{{$value->message}}</td>
    <td>
    <a href='{{route("query.view", $value->id)}}'   target="_blank" class="btn btn-outline-success btn-xs view">View</a>
    <button data-id="{{$value->id}}" class="btn btn-danger btn-xs remove">Remove</button>
    </td>
    </tr>
    @empty
    <center>
    <h3> No Query </h3>
    </center>
    @endforelse
</tbody>
</table>
</div>
<div id="num"  data-page="{{$query->currentPage()}}">    
 {{$query->links()}} 
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->
