<div class="row pt-4">
  <div class="col-12 col-sm-6 col-md-4  mb-5 sm-md-0">
    <div class="info-box">
      <span class="info-box-icon bg-info elevation-1"><i class="fa fa-user-o"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Total Register User</span>
        <span class="info-box-number">
         {{$user}}
        </span>
        <div>
       <a href="{{ route('userexport') }}" class="btn btn-warning w-100 btn-sm py-0">Export Report</a>
     </div>
      </div>
    </div>
  </div>
 
  <div class="col-12 col-sm-6 col-md-4">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-secondary elevation-1"><i class="fa fa-question-circle-o"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Total Queries</span>
        <span class="info-box-number">{{$query}} </span>
        <div>
       <a href="{{ route('queryexport') }}" class="btn btn-warning w-100 btn-sm py-0">Export Report</a>
      </div>
      </div>
    </div>
  </div>

  <div class="col-12 col-sm-6 col-md-4">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-secondary elevation-1"><i class="fa fa-question-circle-o"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Category has Maximum Query</span>
        <span class="info-box-number"> {{$maxquery}}</span>
        <div>
       <a href="{{ route('maxqueryexport') }}" class="btn btn-warning w-100 btn-sm py-0">Export Report</a>
     </div>
      </div>
    
    </div>
  </div>

  <div class="col-12 col-sm-6 col-md-4">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-secondary elevation-1"><i class="fa fa-question-circle-o"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Category has Minimum Query</span>
        <span class="info-box-number"> {{$minquery}}</span>
        <div>
       <a href="{{ route('minqueryexport') }}" class="btn btn-warning w-100 btn-sm py-0">Export Report</a>
     </div>
      </div>
    </div>
  </div>

  <div class="col-12 col-sm-6 col-md-4">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-secondary elevation-1"><i class="fa fa-question-circle-o"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Category has Maximum Twenty  Query</span>
        <span class="info-box-number"> {{$maxtwenty}}</span>
        <div>
       <a href="{{ route('maxtwentyexport') }}" class="btn btn-warning w-100 btn-sm py-0">Export Report</a>
     </div>
      </div>
    </div>
  </div>

<<<<<<< HEAD
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
<div class="text-right">
<a href="{{ route('reportexport') }}" class="btn btn-warning btn-xs mt-3">Export Report</a>
</div>
</div>
<div id="num"  data-page="">    
=======
  <div class="col-12 col-sm-6 col-md-4">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-secondary elevation-1"><i class="fa fa-question-circle-o"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Category has Minimum Twenty  Query</span>
        <span class="info-box-number"> {{$mintwenty}}</span>
        <div>
       <a href="{{ route('mintwentyexport') }}" class="btn btn-warning w-100 btn-sm py-0">Export Report</a>
      </div>
      </div>
    </div>
  </div>
>>>>>>> e89b997c249b9af7317d058b8d2624f728f69d53
 
  <div class="col-12 col-sm-6 col-md-4  mb-5 sm-md-0">
    <div class="info-box">
      <span class="info-box-icon bg-info elevation-1"><i class="fa fa-user-o"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Service Provider has maximum query</span>
        <span class="info-box-number"> {{$maxqueryprovider}}</span>
        <div>
       <a href="{{ route('maxproviderexport') }}" class="btn btn-warning w-100 btn-sm py-0">Export Report</a>
      </div>
      </div>
    </div>
  </div>

  <div class="clearfix hidden-md-up"></div>
</div>
   
 


