
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
    <th>Query type</th>
    <th>Message</th>
     <th style="width:15%">Action</th>
    </tr>
    </thead>
    @endif
    <tbody>
    @forelse($data as $key=>$value)
    <tr>
    <td>{{$key+$data->firstItem()}}</td>
    <td><a href="/admin/customer/view/{{$value->from_user}}" style="color:#000;">{{$value->first_name}}</a></td>
     <td>{{$value->type}}</td>
    <td>{{$value->message}}</td>
    <td>
    <a href='{{route("contactquery.view", $value->id)}}'   target="_blank" class="btn btn-outline-dark btn-xs view">View</a>
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
<div class="mt-3">  
 {{$data->links()}}
</div> 
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->
