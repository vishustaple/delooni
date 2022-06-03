@extends('admin.layout.template')
@section('contents')
<div class="card" id="data">
              <div class="card-header p-2 yellow-bg">
                <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active customer" style="cursor:pointer" 
                        data-toggle="modal" 
                        data-target="#myModal">Add Customer</a></li>
                   <!-- The Modal -->
                    <div class="modal" id="myModal"> 
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h5 class="modal-title">Add Customer</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                        
                          <!-- Modal body -->
                          <div class="modal-body">
                          @include('admin.customer.addcustomer')
                          </div>
                        </div>
                      </div>
                    </div>
                    <li class="nav-item search-right">
                   <div>
                    <div class="input-group" data-widget="sidebar-search">
                      <input class="form-control form-control-sidebar border-0" id="search"  type="search" placeholder="Search" aria-label="Search">
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
              <div class="card-body py-0">
                <div class="tab-content">
                  <div class="active tab-pane" id="view">
                     @include('admin.customer.view')
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
      </div>

      <script>

//hide error
$(document).on("click", "a.nav-link.active.customer", function(){
  
  $(".error").html("");
  $("#add_customers").trigger("reset");
  
});

$("#add_customers").on('submit', function (e){
     e.preventDefault();
     var data = new FormData(this);
     console.log(data);
     $.ajax({
     method:'post',
     url:"{{route('customer.add')}}",
     cache: false,
     contentType: false,
     processData: false,
     dataType: "JSON",
     data : {data: data},
    headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     },
    data:data,
    success:function(data){
   location.reload();
    $("body").removeClass("modal-open");
     },
  error:function(data){
    $('.error').html('');                                      
    $.each(data.responseJSON.errors, function(id,msg){
    $('#error_'+id).html(msg);
 })
}
});
    
})  
function toggleDisableEnable(e){
 var id = $(e).attr('data-id');
 $('#page-loader').show();
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
  });
      $.ajax({
      url:"{{route('customer.update.status')}}",
      data:{id:id},
      dataType: "JSON",
      success:function(data)
      { 
      // var page = $('#test').data('page');
      $('#page-loader').hide();
      location.reload();
   
      },
     error:function(error){
     $('#page-loader').hide();
   }
 });
}

$(document).on('click','.remove',function(){
  var id = $(this).attr('data-id');
  swal({
         title: "Oops....",
         text: "Are you sure you want to delete category ?",
         icon: "error",
         buttons: [
           'NO',
           'YES'
         ],
       }).then(function(isConfirm) {
         if (isConfirm) {
  $('#page-loader').show();
  $.ajax({
  url:"{{route('customer.delete')}}",
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

$(document).on('click', '.update', function(event){
  $('#page-loader').show();
   $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var id = $(this).attr('data-id');
  $.ajax({
        url:'{{route("update")}}',
        data:{id:id},
        success:function(data)
  {
   $('.viewJob_update').empty().html(data);
   $("#myModal1").modal('show');
   $('#page-loader').hide();

  },
  error:function(error){
    console.log(error.responseText);
    $('#page-loader').hide();

  }
 });
});
$(document).on('submit','#update_customer', function(e){
  e.preventDefault();
  var data = new FormData(this);
  console.log(data);
  $.ajax({
    type:'post',
    url:"{{route('customer.update')}}",
    cache:false,
    contentType: false,
    processData: false,
    dataType: "JSON",
    data : {data: data},
    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
            data:data,
            success:function(data){
            window.location.reload();
            setTimeout(function () {
        
            }, 2000);
            },
            error:function(data){
              $('.error').html(''); 
            $.each(data.responseJSON.errors, function(id,msg){
            $('#_error_'+id).html(msg);
            })
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
    var make_url="{{route('customer.search')}}";
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
</script>
@endsection