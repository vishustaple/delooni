<div class="card" id="data">
              <div class="card-header p-2 yellow-bg">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" style="cursor:pointer;" id="serviceform" >Add</a></li>
                  
                  <li class="nav-item search-right">
                   <div>
                      <div class="input-group" data-widget="sidebar-search">
                      <input class="form-control form-control-sidebar" id="search" type="search" placeholder="Search" aria-label="Search">
                      </div>
                   </div>
                  </li>
                </ul>
              </div>
              <div class="card-body py-0">
                <div class="tab-content">
                  <div class="active tab-pane" id="view">
                     @include('admin.serviceprovider.view')
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
      </div>
      <script>
//serviceform on add button click 
$('#serviceform').on('click',function(e){
 e.preventDefault();
 $.ajax({
     type:'get',
     url:"{{route('serviceproviderform')}}",
     cache: false,
     contentType: false,
     processData: false,
     data : {data: data},
     headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     },
    success:function(response){
    console.log(response);
    $(".card-body").html(response);
      },

    error:function(error){                                     
      console.log(error);
 }

});
});
//add data of service provider 
$(document).on("submit", "#createprovider", function(e){
     e.preventDefault();
    let myForm = document.getElementById('createprovider');
    let formData = new FormData(myForm);
     console.log(data);
     $.ajax({
     type:'post',
     url:"{{route('provider.add')}}",
     cache: false,
     contentType: false,
     processData: false,
     dataType: "JSON",
     data :formData,
     headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     },
    success:function(response){
      console.log(response);
      location.reload();
     },
    error:function(data){                                     
    $.each(data.responseJSON.errors, function(id,msg){
    $('#error_'+id).html(msg);
 })
}
});
});

//toggledisableenable
function toggleDisableEnable(e){
  var id = $(e).attr('data-id');
  $('#page-loader').show();
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
  });
  $.ajax({
  url:"{{route('provider.status')}}",
  data:{id:id},
  type:'post',
  success:function(data)
  {
    location.reload();
    $('#page-loader').hide();
  },
  error:function(error){
    $('#page-loader').hide();
  }
 });
}  

//for pagination 
$(document).on('click', '.pagination a', function(event){
 event.preventDefault(); 
 var page = $(this).attr('href').split('page=')[1];
//  var sendurl=$(this).attr('href');
 fetch_data(page);
 
});
//for search 
function fetch_data(page)
{
 $('#page-loader').show();
  var search=document.querySelector("#search").value;
  var data={search};
  var make_url="{{route('provider.search')}}?page="+page;
  $.ajax({
    url:make_url,
    data:data,
    success:function(data)
    {
    $('#view').empty().html(data);
    $('#page-loader').hide();
    },
    error:function(error){
      $('#page-loader').hide();

    }
  });
}
//onclick search call fetch_data function 
document.querySelector("#search").addEventListener("keyup",(e)=>{
  fetch_data(1);
     });

//to update user 
$(document).on('submit', '#update_provider', function(e){
  
  e.preventDefault();
  $('#page-loader').show();

  var formData = new FormData(this);
  $.ajax({
    url:'{{route("provider.updateproviderdata")}}',
    type:'post',
    dataType: "JSON",
    xhr: function() {
      myXhr = $.ajaxSettings.xhr();
      return myXhr;
    },
    cache: false,
    contentType: false,
    processData: false,
    data:formData,
    success:function(data)
    {
    //  fetch_data(1);
     location.reload();
     //$('.updatemodaluser').html(data);
     $('#page-loader').hide();

    },
    error:function(data){

      console.log(data.responseJSON.errors);
      $.each(data.responseJSON.errors, function(id,msg){
        // console.log('ss'+id);

        $('#error_'+id).html(msg);
      });
      $('#page-loader').hide();
    }
  });
});

//to remove user 
$(document).on('click','.remove',function(){
  
  var id = $(this).attr('data-id');
  swal({
         title: "Oops....",
         text: "Are You Sure You want to delete Staff!",
         icon: "error",
         buttons: [
           'NO',
           'YES'
         ],
       }).then(function(isConfirm) {
         if (isConfirm) {
  $('#page-loader').show();
  $.ajax({
  url:"{{route('provider.remove')}}",
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

$(document).on("click", "#serviceform", function(){
  $('#search').hide();
  $(".error").html("");
  $("#createprovider").trigger("reset");
  
});

  //update form on update button 
  $('.updateserviceprovider').on('click',function(e){ 
   e.preventDefault();
   var id=$(this).attr("data-userid");
   console.log(id);
   var url = '{{ route("provider.updateform", ":id") }}';
    url = url.replace(':id', id );
   $.ajax({
     headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     },
     type:'get',
     url:url,
     cache: false,
     contentType: false,
     processData: false,
    success:function(response){
    console.log(response);
    $(".card-body").html(response);
      },

    error:function(error){                                     
      console.log(error);
 }

});
});
//ajax for subcategory
$(document).on('change','#service_category_id',function(e){
          
            var id = e.target.value;
            console.log(id);
            var url = '{{ route("provider.category", ":id") }}';
             url = url.replace(':id', id );
            //ajax
            $.ajax({
            type:'get',
            url:url,
            cache: false,
            contentType: false,
            processData: false,
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
              success:function(response){
              console.log(response);
              var subcategories = '<select class="form-control select2" id="_service_category_id" name="_service_category_id"><option value="N/A" disabled selected="true">--Select sub category--</option>'; 
              
  
              $.each(response, function (key, value) {                     

                subcategories += '<option class="form-drop-items" value='+value.id+'>'+value.name+'</option>';
                
              });   
              subcategories += '</select>'; 

              $("#subcategory").html(subcategories);  
                },

              error:function(error){                                     
                console.log(error);
          }
});
});


</script>
