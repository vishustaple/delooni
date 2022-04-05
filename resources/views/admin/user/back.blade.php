<div class="col-sm-12">
 <button class="btn btn-outline-success float-right" id="user"><i class="fas fa-arrow-alt-circle-left">Back</i></button>
</div> 
<script>
 jQuery("#user").on("click",(e)=>{
  
  
     $.ajax({
       type:"get",
       url:"{{url('/')}}/admin/user/back",
       success: function(data){
        window.location = data;
       }
     })
 })  
</script>