<style>
td table {
    width: 100%;
}
.excel-table tbody table tr td {
    border-width: 0px 0px 1px 0px !important;
}

</style>

<div class="card" id ="test">
    <div class="card-header">
        <h3 class="card-title">Report List</h3>
    </div>
    <!-- CUSTOM TABLE  -->
    <table class="table table-bordered excel-table">
    
  <thead>
    <tr>
      <th scope="col">S.no.</th>
      <th scope="col">Total User</th>
      <th scope="col">Total Query</th>
      <th scope="col">category has minimum query</th>
      <th scope="col">category has maximum twenty query</th>
      <th scope="col">category has minimum twenty query</th>
      <th scope="col">Service Provider with maximum twenty query</th>
    </tr>
  </thead>
  <tbody>
  <tr>
            <td> 
                <table>
                    @forelse($user as $key=>$value)
                    <tr>
                        <td>{{$key+1}}</td>
                    </tr>
                    @empty
                    @endforelse
                </table>
            </td>
            <td> 
                <table>
                    @forelse($user as $key=>$value)
                    <tr>
                        <td>{{$value->first_name}}</td>
                    </tr>
                    @empty
                    @endforelse
                </table>
            </td>

            <td>   
                <table>
                    @forelse($query as $key=>$value)
                    <tr>
                        <td>{{$value->subject}}</td>
                    </tr>
                    @empty
                    @endforelse
                </table>
            </td>

            <td>   
                <table>
                        @forelse($minquery as $key=>$value)
                        <tr>
                            <td>{{$value->name}}</td>
                        </tr>
                        @empty
                        @endforelse
                </table>
            </td>

            <td>   
                <table>
                    @forelse($maxtwenty as $key=>$value)
                    <tr>
                        <td>{{$value->name}}</td>
                    </tr>
                    @empty
                    @endforelse
                </table>
            </td>

            <td>   
                <table>
                    @forelse($mintwenty as $key=>$value)
                    <tr>
                        <td>{{$value->name}}</td>
                    </tr>
                    @empty
                    @endforelse
                </table>
            </td>

            <td>   
                <table>
                    @forelse($maxtwentyprovider as $key=>$value)
                    <tr>
                        <td>{{$value->first_name}}</td>
                    </tr>
                    @empty
                    @endforelse
                </table>
            </td>
 
            </tr>
    </tbody>
  
</table>

    <div class="p-3">
       <a href="{{ route('reportexport') }}" class="btn btn-warning w-25 btn-sm py-2">Export Report</a>
    </div>
 </div>


