<div class="card" id ="test">
    <div class="card-header">
    <h3 class="card-title">Report List</h3>
</div>
   <!-- /.card-header -->
   <div class="card-body">
   <table class="table table-bordered">
    
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
<a href="{{ route('reportexport') }}" class="btn btn-warning btn-xs">Export Report</a>
</div>
<div id="num"  data-page="{{}}">    
 
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->