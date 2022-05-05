<div class="row pt-4">
<a href="{{route('customer')}}">
  <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
   <div class="info-box">
     <span class="info-box-icon bg-info elevation-1"><i class="fa fa-user-o"></i></span>
       <div class="info-box-content">
        <span class="info-box-text text-dark">Register Customer</span>
        <span class="info-box-number">
         {{$customer}}
        </span>
      </div>
    </div>
    </a>
  </div>
  <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
  <a href="{{route('viewserviceprovider')}}">
    <div class="info-box mb-3">
    <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-cogs"></i></span>
      <div class="info-box-content">
        <span class="info-box-text text-dark">Individual Service provider</span>
        <span class="info-box-number"> {{$individual_service_provider}}</span>
      </div>
    </div>
    </a>
  </div>

  <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
  <a href="{{route('viewserviceprovider')}}">
    <div class="info-box mb-3">
    <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-cogs"></i></span>
       <div class="info-box-content">
        <span class="info-box-text text-dark">Service provider with company</span>
        <span class="info-box-number"> {{$company_service_provider}}</span>
      </div>
    </div>
    </a>
  </div>

  <div class="col-12 col-sm-6 col-md-4">
  <a href="{{url('/admin/query')}}">
    <div class="info-box mb-3">
    <span class="info-box-icon bg-secondary elevation-1"><i class="fa fa-question-circle-o"></i></span>

      <div class="info-box-content">
        <span class="info-box-text text-dark">Total Queries</span>
        <span class="info-box-number">{{$query}} </span>
      </div>
    </div>
    </a>
  </div>
  <div class="clearfix hidden-md-up"></div>
</div>