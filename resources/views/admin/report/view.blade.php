<div class="card shadow-none border-0" id ="test">
   <!-- /.card-header -->
   <div class="card-body p-0 border-0">
   <div class="table-responsive">
   <table class="table">
    
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
</table>

</div>
<div id="num"  data-page="">    
 
            </tr>
    </tbody>
  
</table>

    <div class="p-3">
       <a href="{{ route('reportexport') }}" class="btn btn-warning w-25 btn-sm py-2">Export Report</a>
    </div>
 </div>


