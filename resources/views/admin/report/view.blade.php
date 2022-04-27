<div class="card shadow-none border-0" id ="test">
    <div class="card-header px-0">
    <h3 class="card-title font-weight-bold">Report List</h3>
</div>
   <!-- /.card-header -->
   <div class="card-body p-0 border-0">
   <div class="table-responsive">
   <table class="table">
    
    <thead>
    <tr>
    <th style="width: 10px">S.no.</th>
    <th>Total User</th>
    <th>Total query</th>
    <th>Category with maximum query</th>
    <th>Category with minimum Query</th>
    <th>Service Provider with maximum query</th>
    <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @forelse($user as $key=>$value)
    <tr>
    <td>{{$key+1}}</td>
    <td>{{$value->first_name}}</td>
    </tr>
    @empty
    <center>
    <h3> No Query </h3>
    </center>
    @endforelse
</tbody>
</table>
</table>
<div class="text-right">
<a href="{{ route('reportexport') }}" class="btn btn-warning btn-xs mt-3">Export Report</a>
</div>
</div>
<div id="num"  data-page="{{}}">    
 
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->