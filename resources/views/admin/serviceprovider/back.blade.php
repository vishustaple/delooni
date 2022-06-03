<div class="col-md-6">
    <?php
  
   if ($data['service_provider_type'] =="company"){?>
    <a href="{{url('/')}}/company"  class="btn btn-dark float-right">  <i class="fa fa-arrow-circle-left"></i> 
    Back
    </a>
    <?php
   }else{
       ?>
    <a href="{{url('/')}}/serviceprovider"  class="btn btn-dark float-right">  <i class="fa fa-arrow-circle-left"></i> 
    Back
    </a>
    <?php
   }
    ?>
 
</div> 
