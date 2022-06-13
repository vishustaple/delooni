<div class="col-md-6 justify-content-end">
<button class="btn btn-dark float-right" id="user"><i class="fa fa-arrow-circle-left pr-2"></i>Back</button>
</div> 
<script>
 jQuery("#user").on("click",(e)=>{
     $.ajax({
       type:"get",
       url:"{{url('/')}}/admin/query/back",
       success: function(data){
        window.location = data;
       }
     })
 })  
</script> 