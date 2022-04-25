<style>
td table {
    width: 100%;
}

</style>

<div class="card" id ="test">
    <div class="card-header">
    <h3 class="card-title">Report List</h3>
</div>
    <!-- CUSTOM TABLE  -->
    <table class="table table-bordered">
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
            <tr>
                <td>
                @forelse($user as $key=>$value)
                    <tr>
                        <td>{{$key+1}}</td>
                    </tr>
                    @empty
                    @endforelse
                </td>
            </tr>
        </table>
      <td> 
        <table>
            <tr>
                <td>
                @forelse($user as $key=>$value)
                    <tr>
                        <td>{{$value->first_name}}</td>
                    </tr>
                    @empty
                    @endforelse
                </td>
            </tr>
        </table>
      </td>

      <td>   
        <table>
            <tr>
                <td>
                    @forelse($query as $key=>$value)
                <tr>
                    <td>{{$value->subject}}</td>
                </tr>
                @empty
                @endforelse
                </td>
            </tr>
        </table>
      </td>
      <td>   
        <table>
            <tr>
                <td>
                    @forelse($minquery as $key=>$value)
                    <tr>
                        <td>{{$value->name}}</td>
                    </tr>
                    @empty
                    @endforelse
                </td>
            </tr>
        </table>
      </td>
      <td>   
        <table>
            <tr>
                <td>
                @forelse($maxtwenty as $key=>$value)
    <tr>
    <td>{{$value->name}}</td>
    </tr>
    @empty
    @endforelse
                </td>
            </tr>
        </table>
      </td>
      <td>   
        <table>
            <tr>
                <td>
                @forelse($mintwenty as $key=>$value)
    <tr>
    <td>{{$value->name}}</td>
    </tr>
    @empty
    @endforelse
                </td>
            </tr>
        </table>
      </td>
      <td>   
        <table>
            <tr>
                <td>
                @forelse($maxtwentyprovider as $key=>$value)
    <tr>
    <td>{{$value->first_name}}</td>
    </tr>
    @empty
    @endforelse
                </td>
            </tr>
        </table>
      </td>
     
    </tr>
    
  </tbody>
</table>


    <a href="{{ route('reportexport') }}" class="btn btn-warning btn-xs">Export Report</a>
    </div>
<!-- /.card-body -->
</div>
<!-- /.card -->