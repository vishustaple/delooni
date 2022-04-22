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
    </tr>
    </thead>

    <tbody>
    @forelse($user as $key=>$value)
    <tr>
    <td>{{$key+1}}</td>
    <td>{{$value->first_name}}</td>
    </tr>
    @empty
    @endforelse
   
    
    <tr>
    <th style="width: 10px">S.no.</th>
    <th>Total query</th>
    </tr>
    @forelse($query as $key=>$value)
    <tr>
    <td>{{$key+1}}</td>
    <td>{{$value->subject}}</td>
    </tr>
    @empty
    @endforelse

   
    <tr>
    <th style="width: 10px">S.no.</th>
    <th>category has minimum query</th>
    </tr>
    @forelse($minquery as $key=>$value)
    <tr>
    <td>{{$key+1}}</td>
    <td>{{$value->name}}</td>
    </tr>
    @empty
    @endforelse

    
    <tr>
    <th style="width: 10px">S.no.</th>
    <th>category has maximum twenty query</th>
    </tr>
    @forelse($maxtwenty as $key=>$value)
    <tr>
    <td>{{$key+1}}</td>
    <td>{{$value->name}}</td>
    </tr>
    @empty
    @endforelse

   
    <tr>
    <th style="width: 10px">S.no.</th>
    <th>category has minimum twenty query</th>
    </tr>
    @forelse($mintwenty as $key=>$value)
    <tr>
    <td>{{$key+1}}</td>
    <td>{{$value->name}}</td>
    </tr>
    @empty
    @endforelse

   
    <tr>
    <th style="width: 10px">S.no.</th>
    <th>Service Provider with maximum twenty query</th>
    </tr>
    @forelse($maxtwentyprovider as $key=>$value)
    <tr>
    <td>{{$key+1}}</td>
    <td>{{$value->first_name}}</td>
    </tr>
    @empty
    @endforelse
   </tbody>
    </table>
    </table>
    <a href="{{ route('reportexport') }}" class="btn btn-warning btn-xs">Export Report</a>
    </div>
<!-- /.card-body -->
</div>
<!-- /.card -->