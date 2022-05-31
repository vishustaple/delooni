<div class="col-sm-12">
 <button class="btn btn-dark float-right" id="user"><i class="fa fa-arrow-circle-left pr-2"></i>Back</button>
</div> 
<script>
 jQuery("#user").on("click",(e)=>{
  
  
     $.ajax({
       type:"get",
       url:"{{url('/')}}/admin/city/back",
       success: function(data){
        window.location = data;
       }
     })
 })  
</script>