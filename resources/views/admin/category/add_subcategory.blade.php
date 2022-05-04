<form class="form-horizontal"  id="add_subcategory"   enctype="multipart/form-data">
                      @csrf
                      <div class="form-group row">
                        <label for="name" class="col-sm-12 col-form-label">Sub Category Name </label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="name" name="name" placeholder="Enter Sub category name">
                          <div class="error" id="error_name">
                         </div>
                        </div>
                      </div>
                 <div class="form-group row">
                        <label class="col-sm-12 col-form-label">Sub category Image </label>
                        <div class="col-sm-12">
                          <input type="file" class="form-control" id="service_category_image" name="service_category_image" placeholder="Upload Service category Image">
                          <div class="error" id="error_service_category_image">
                         </div>
                        </div>
                      </div>  

                     <div class="form-group row">
                        <label for="is_parent" class="col-sm-12 col-form-label">Parent category </label>
                          <div class="col-sm-12">
                          <select class="form-control" id="is_parent" name="is_parent">
                  @foreach($getnames as $getname)
                      <option class="form-drop-items" value="{{$getname->id}}">{{$getname->name}}</option>
                 @endforeach
               </select>
                 </div>
                  </div>
                 <div class="form-group row">
                        <div class="col-sm-12 text-center">
                          <button type="submit" class="btn app-button">Submit</button>
                          <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                      </div>
                    </form>
                    <script>
    $("#add_subcategory").on('submit', function (e){
     e.preventDefault();
     var data = new FormData(this);
     console.log(data);
     $.ajax({
     method:'post',
     url:"{{route('subcategory.add')}}",
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
                                         
    $.each(data.responseJSON.errors, function(id,msg){
    $('#error_'+id).html(msg);
 })
}
});
    
}) 
$(document).on("keyup","#search",(e)=>{
    fetch_data(1);
});

function fetch_data(page)
{
    $('#page-loader').show();
    let value=document.querySelector("#search").value;
    var make_url="{{route('category.search')}}";
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
  url:"{{route('category.delete')}}",
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
        url:'{{route("category.view.update")}}',
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
$(document).on('submit','#update_category', function(e){
  e.preventDefault();
  var data = new FormData(this);
  console.log(data);
  $.ajax({
    type:'post',
    url:"{{route('category.update')}}",
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
            $.each(data.responseJSON.errors, function(id,msg){
            $('#error_'+id).html(msg);
            })
            }
        });
      });

      function toggleDisableEnable(e){
 var id = $(e).attr('data-id');
 $('#page-loader').show();
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
  });
      $.ajax({
      url:"{{route('category.update.status')}}",
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
</script>