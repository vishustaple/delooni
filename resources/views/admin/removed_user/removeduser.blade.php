
<div class="card border-0 shadow-none" id ="test">
    
    <!-- /.card-header -->
    <div class="card-body p-0">
    <div class="table-responsive table-bordered">
    <table class="table">
     @if(count($data)>0)
     <thead>
     <tr>
     <th style="width: 10px;">S.no.</th>
     <th>Name</th>
     <th>User Type</th>
     <!-- <th style="width:15%">Action</th> -->
     </tr>
     </thead>
     @endif
     <tbody>
     @forelse($data as $key=>$value)
     <tr>
     <td>{{$key+ $data->firstItem()}}</td>
     <td>{{$value->first_name}} {{$value->last_name}}</td>
     @if($value->service_provider_type=="default")
     <td>Customer</td>
     @else
     <td>{{$value->service_provider_type}}</td>
     @endif
     <td>
     </td>
     </tr>
     @empty
     <h5 class="text-center p-2"> No User </h5>
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