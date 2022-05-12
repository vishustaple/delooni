
<div class="card border-0 shadow-none" id ="test">
    
   <!-- /.card-header -->
   <div class="card-body p-0">
       <div class="table-responsive table-bordered">
   <table class="table">
    @if(count($data)>0)
    <thead>
    <tr>
    <th style="width: 10px;">S.no.</th>
    <th>Customer name</th>
    <th>Category name</th>
    <th>Subject</th>
    <th>Issue</th>
    <th>Message</th>
     <th style="width:15%">Action</th>
    </tr>
    </thead>
    @endif
    <tbody>
    @forelse($data as $key=>$value)
    <tr>
    <td>{{$key+1}}</td>
    <td>{{$value->first_name}}</td>
    <td>{{$value->name}}</td>
     <td>{{$value->subject}}</td>
    <td>{{$value->reporting_issue}}</td>
    <td>{{$value->message}}</td>
    <td>
    <a href='{{route("query.view", $value->id)}}'   target="_blank" class="btn btn-outline-dark btn-xs view">View</a>
    <button data-id="{{$value->id}}" class="btn btn-danger btn-xs remove">Remove</button>
    </td>
    </tr>
    @empty
    <h5 class="text-center p-2"> No Query </h5>
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
