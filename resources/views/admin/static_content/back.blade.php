<div class="col-sm-12">
 <button class="btn btn-dark float-right" id="user"><i class="fas fa-arrow-alt-circle-left pr-2"></i>Back</button>
</div> 
<script>
 jQuery("#user").on("click",(e)=>{
  
  
     $.ajax({
       type:"get",
       url:"{{url('/')}}/admin/content/back",
       success: function(data){
        window.location = data;
       }
     })
 })  
</script>