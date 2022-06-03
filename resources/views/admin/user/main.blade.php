<div class="card" id="data">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" style="cursor:pointer" 
                        data-toggle="modal" 
                        data-target="#myModal">Add</a></li>
                                      <!-- The Modal -->
                    <div class="modal" id="myModal"> 
                      <div class="modal-dialog modal-lg" >
                        <div class="modal-content">

                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h4 class="modal-title">Register</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>

                          <!-- Modal body -->
                          <div class="modal-body">
                          @include('admin.user.addform')
                          </div>
                        </div>
                      </div>
                    </div>
                  <!-- <li class="nav-item"><a class="nav-link" href="#view" data-toggle="tab">Add User</a></li> -->
                  <li class="nav-item search-right">
                   <div>
                      <div class="input-group" data-widget="sidebar-search">
                      <input class="form-control form-control-sidebar" id="search" type="search" placeholder="Search" aria-label="Search">
                      </div>
                   </div>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="view">
                     @include('admin.user.view')
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
      </div>
      <script>
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
  var make_url="{{route('user.search')}}?page="+page;
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

 //const base_url=$('meta[name="base-url"]').attr('content');

 //to add user call 
$("#createUser").on('submit',(e)=>{
    e.preventDefault();
    const data=getformdata("createUser");
    
    userRegisterAjax('post','/admin/user/adduser',data);
});  
//function call to get data from form 
function getformdata(id){
    let form = document.querySelector(`#${id}`);
    let data = new FormData(form);
    var object={};
    for (let [key, value] of data) {
        object[key]=value;
    }
    var FormValuedata=object;
    return FormValuedata;
   }
   function errormessage(id,value){
    if(value){
        document.querySelector(`#${id}`).innerText=value;
      }else{
        document.querySelector(`#${id}`).innerText="";
      }
}
function removemessage(value){
    $(`.${value}`).empty();
}
function userRegisterAjax(type,path,data){
    $.ajax({
        type:type,
        url:`${base_url}${path}`,
        header:{
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        },
        data:data,
        success:function(data){
            removemessage('error');
            window.location.reload();
        },
        error:function(data){
            errormessage('error_name',data.responseJSON.errors.name);
            errormessage('error_email',data.responseJSON.errors.email);
            errormessage('error_password',data.responseJSON.errors.password);
          
        }
      });
} 
function toggleDisableEnable(e){
  var id = $(e).attr('data-id');
  $('#page-loader').show();
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
  });
  $.ajax({
  url:"{{route('user.update.status')}}",
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
$(document).on('submit', '#update_user', function(e){
  e.preventDefault();
  $('#page-loader').show();

  var formData = new FormData(this);
  $.ajax({
    url:'{{route("user.updateuserdata")}}',
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
     fetch_data(1);
     $('.updatemodaluser').html(data);
     $('#page-loader').hide();

    },
    error:function(data){
      console.log(data.responseJSON.errors);
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
  url:"{{route('user.remove')}}",
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

</script>