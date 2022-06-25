@extends('admin.layout.template')
@section('contents')
<div class="card" id="data">
              <div class="card-header p-2 yellow-bg">
                <ul class="nav nav-pills">
                <li class="nav-item">
                  <h3 class="card-title mt-2">Payment History List</h3>
                </li>
                    
                  <li class="nav-item search-right">
                   <div>
                    <div class="input-group" data-widget="sidebar-search">
                      <input class="form-control form-control-sidebar border-0" id="search" type="search" placeholder="Search" aria-label="Search">
                      <div class="input-group-append">
                        <button class="btn btn-sidebar bg-white">
                          <i class="fa fa-search"></i>
                        </button>
                      </div>
                    </div>
                   </div>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="view">
                  @include('admin.payment.view')
                 </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
      </div>
<script>
$(document).on('click','.remove',function(){
  var id = $(this).attr('data-id');
  swal({
         title: "Oops....",
         text: "Are you sure you want to delete payment History ?",
         icon: "error",
         buttons: [
           'NO',
           'YES'
         ],
       }).then(function(isConfirm) {
         if (isConfirm) {
  $('#page-loader').show();
  $.ajax({
  url:"{{route('payment.delete')}}",
  data:{id:id},
  success:function(data)
  {
    swal({
          position: 'top-end',
          icon: 'success',
          title: 'Remove Successfully',
          showConfirmButton: false,
          timer: 1500
          })
   location.reload();
   $('#page-loader').hide();
  },
  error:function(error){
    $('#page-loader').hide();
  }
 });
 } else {
}
});
});

$(document).on("keyup","#search",(e)=>{ 
fetch_data(1);
});

function fetch_data(page)
{
    $('#page-loader').show();
    let value=document.querySelector("#search").value;
    var make_url="{{route('payment.search')}}";
    var data={'page':page,'search':value};
    $.ajax({
        url:make_url,
        data:data,
        success:function(data)
        { 
        $('#test').empty().html(data);
        $('#page-loader').hide();
        },
        error:function(error){
        $('#page-loader').hide();
        }
    })
}
$(document).on('click', '.pagination a', function(event){
 event.preventDefault();
 var page = $(this).attr('href').split('page=')[1];
 var sendurl=$(this).attr('href');
 fetch_data(page);
 
});
//get data on date range

$(document).on("submit", "#get_info_payment", function(e){
  
  e.preventDefault();
  var formData = new FormData(this);
   $.ajax({
   type:'post',
   url:"{{route('paymentdaterange')}}",
   cache: false,
   contentType: false,
   processData: false,
   data :formData,
   headers: {
   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   },
   success:function(data){
    $('.error').html(''); 

    var successHtml = $($.parseHTML(data)).find("#info_payment").html();
    $('div#info_payment').html(successHtml);
  
   },
   error:function(data){ 
    $('.error').html(''); 
    $.each(data.responseJSON.errors, function(id,msg){
    $('#get_info_payment #error_'+id).html(msg);
})
}
});
});
</script>
@endsection