@extends('admin.layout.template')
@section('contents')
<div id="Provider_data">
<div class="card" id="data">
              <div class="card-header p-2 yellow-bg provider">
           


              <div class="row align-items-center" style="display:none;">
                  <div class="col-md-6">
                    <h3 class="card-title font-weight-bold">Update User</h3> 
                    </div>
                <div class="col-md-6">
 <a href="{{url('/company')}}" class="btn btn-dark float-right"><i class="fa fa-arrow-circle-left"></i>
 Back
 </a>
</div> 
               </div> 







                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" style="cursor:pointer;" id="serviceform" >Add</a></li>
                  
                  <li class="nav-item search-right hide">
                 
                   <div class="serviceProviderBack">
                    <div class="input-group" data-widget="sidebar-search" id="searchp">
                      <input class="form-control form-control-sidebar border-0" id="search1" type="search" placeholder="Search" aria-label="Search">
                      <div class="input-group-append">
                        <button class="btn btn-sidebar bg-white">
                          <i class="fa fa-search"></i>
                        </button>
                      </div>
                   
                    </div> 
                    <div style="display:none" id="back">
                      @include('admin.serviceprovider.back')
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
</div>
<script>
  $("button.btn.btn-outline-dark.btn-xs.updateserviceprovider").on('click',function(e){
    $('#Provider_data ul.nav.nav-pills').hide();
  $('.row.align-items-center').show();
});
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
  var search=document.querySelector("#search1").value;
  var data={search};
  var make_url="{{route('provider.company.search')}}?page="+page;
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
document.querySelector("#search1").addEventListener("keyup",(e)=>{
  fetch_data(1);
     });
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
    $(".card-body").html(response);
    const phoneInputField = document.querySelector("#phone");
    const phoneInput = window.intlTelInput(phoneInputField, {
    utilsScript:
    "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    initialCountry: "sa",

    });
      },

    error:function(error){                                     
 }

});
});
//add data of service provider 
$(document).on("submit", "#createprovider", function(e){
     e.preventDefault();
    let myForm = document.getElementById('createprovider');
    let formData = new FormData(myForm);
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
      location.reload();
     },
    error:function(data){  
      $('.error').html('');                                   
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
     location.reload();
     $('#page-loader').hide();

    },
    error:function(data){

      $('.error').html('');  
      $.each(data.responseJSON.errors, function(id,msg){

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
  $('#searchp').hide();
  $('#back').show();
  $(".error").html("");
  $("#createprovider").trigger("reset");
  
});

  //update form on update button 
  $('.updateserviceprovider').on('click',function(e){ 
  $('.card-header.p-2.yellow-bg.menu-is-opening.menu-open').hide();
   e.preventDefault();
   var id=$(this).attr("data-userid");
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
    $(".card-body").html(response);
      },

    error:function(error){                                     
 }

});
});
//ajax for subcategory
$(document).on('change','#service_category_id',function(e){
           var id = e.target.value;
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
              var subcategories = '<select class="form-control select2" id="_service_category_id" name="_service_category_id"><option value="N/A" disabled selected="true">--Select sub category--</option>'; 
              
  
              $.each(response, function (key, value) {                     

                subcategories += '<option class="form-drop-items" value='+value.id+'>'+value.name+'</option>';
                
              });   
              subcategories += '</select>'; 

              $("#subcategory").html(subcategories);  
                },

              error:function(error){                                     
             
          }
});
});
/* google map api script */

$(document).on("click", "#address", function(){
var autocomplete = new google.maps.places.Autocomplete($("#address")[0], {});
google.maps.event.addListener(autocomplete, 'place_changed', function() {
var place = autocomplete.getPlace();
$('#latitude').val(place.geometry.location.lat());
$('#longitude').val(place.geometry.location.lng());
});
});

//ajax for range data 
$(document).on("submit", "#get_info_provider", function(e){
e.preventDefault();
  let myForm = document.getElementById('get_info_provider');
  let formData = new FormData(myForm);
   $.ajax({
   type:'post',
   url:"{{route('companydaterange')}}",
   cache: false,
   contentType: false,
   processData: false,
   data :formData,
   headers: {
   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   },
  success:function(data){
    $('.error').html(''); 
    var successHtml = $($.parseHTML(data)).find("#provider").html();
    $('div#provider').html(successHtml);
   },
  error:function(data){ 
  $('.error').html(''); 
  $.each(data.responseJSON.errors, function(id,msg){
  $('#get_info_provider #error_'+id).html(msg);
})
}
});
});
/*country code*/
$(document).on('change','#phone',function(){
      var countryCode = $('#phoneC .iti__selected-flag').attr('title');
      var countryCode=countryCode.split(':');
      var countryCode = countryCode[1];
      $("#country_code").val(countryCode);
        });
</script>
@endsection