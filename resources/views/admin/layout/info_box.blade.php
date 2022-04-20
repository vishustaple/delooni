<div class="row">
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-info elevation-1"><i class="fa fa-user"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Register Customer</span>
        <span class="info-box-number">
          {{DB::table('users')->where('status','!=',0)->count()}}
        </span>
      </div>
    </div>
  </div>
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-user"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Service provider</span>
        <span class="info-box-number"> {{DB::table('users')->where('status','=',0)->count()}}</span>
      </div>
    </div>
  </div>
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-secondary elevation-1"><i class="fa fa-question"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Total Queries</span>
        <span class="info-box-number">{{DB::table('reports')->where('status','=',1)->count()}} </span>
      </div>
    </div>
  </div>
  <div class="clearfix hidden-md-up"></div>
</div>