<div class="card" id="data">
  <div class="card-header p-2 yellow-bg">
    <ul class="nav nav-pills">
      <li class="nav-item"><a class="nav-link active city" style="cursor:pointer" data-toggle="modal" data-target="#myModal">Add</a></li>
      <!-- The Modal -->
      <div class="modal" id="myModal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Add City</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              @include('admin.Cities.addform')
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
        @include('admin.Cities.view')
      </div>
      <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
  </div><!-- /.card-body -->
</div>
<script>
            //hide error
$(document).on("click", "a.nav-link.active.city", function(){
  
  $(".error").html("");
  $("#createCity").trigger("reset");
  
});
  //for pagination 
  $(document).on('click', '.pagination a', function(event) {
    event.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    //  var sendurl=$(this).attr('href');
    fetch_data(page);

  });
  //for search 
  function fetch_data(page) {
    $('#page-loader').show();
    var search = document.querySelector("#search").value;
    var data = {
      search
    };
    var make_url = "{{route('city.search')}}?page=" + page;
    $.ajax({
      url: make_url,
      data: data,
      success: function(data) {
        $('#view').empty().html(data);
        $('#page-loader').hide();
      },
      error: function(error) {
        $('#page-loader').hide();

      }
    });
  }
  //onclick search call fetch_data function 
  document.querySelector("#search").addEventListener("keyup", (e) => {
    fetch_data(1);
  });

  //const base_url=$('meta[name="base-url"]').attr('content');

  //to add city
  $("#createCity").on('submit', function(e) {
    e.preventDefault();
    var data = new FormData(this);
    $.ajax({
      method: 'post',
      url: "{{route('city.add')}}",
      data:  data,
      cache: false,
      contentType: false,
      processData: false,
      dataType: 'JSON',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
        location.reload();
        $("body").removeClass("modal-open");
      },
      error: function(data) {
        $('.error').html(''); 
        if( data.status === 422 ){
          //$.each(data.responseJSON.errors, function(id, msg) {
          $.each(JSON.parse(data.responseText).message, function(id, msg) {
            $('#error_' + id).html(msg);
          })
        }
      }
    });

  })
  //change city status
  function toggleDisableEnable(e) {
    var id = $(e).attr('data-id');
    $('#page-loader').show();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "{{route('city.update.status')}}",
      data: {
        id: id
      },
      type: 'post',
      success: function(data) {
        location.reload();
        $('#page-loader').hide();
      },
      error: function(error) {
        $('#page-loader').hide();
      }
    });
  }
  //return update form 
  $(document).on('click', '.update', function(event) {
    $('#page-loader').show();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var id = $(this).attr('data-id');
    $.ajax({
      url: '{{route("city.updatecity")}}',
      data: {
        id: id
      },
      success: function(data) {
        $('.updatemodalcity').empty().html(data);
        $("#myModal1").modal('show');
        $('#page-loader').hide();
      },
      error: function(error) {
        $('#page-loader').hide();

      }
    });
  });
  //to update user 
  $(document).on('submit', '#update_city', function(e) {
  
    e.preventDefault();
    $('#page-loader').show();

    var formData = new FormData(this);
    $.ajax({
      url: '{{route("city.updatecitydata")}}',
      type: 'post',
      dataType: "JSON",
      xhr: function() {
        myXhr = $.ajaxSettings.xhr();
        return myXhr;
      },
      cache: false,
      contentType: false,
      processData: false,
      data: formData,
      headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
      success: function(data) {
        fetch_data(1);
        $('.updatemodalcity').html(data);
        $('#page-loader').hide();
        $(".modal-backdrop").removeClass('modal-backdrop show');
      },
      error:function(data){
        $('.error').html('');
            $.each(data.responseJSON.errors, function(id,msg){
            $('#update_city #error_'+id).html(msg);
            })
            }
    });
  });

  //to remove user 
  $(document).on('click', '.remove', function() {

    var id = $(this).attr('data-id');
    swal({
      title: "Oops....",
      text: "Are You Sure You want to delete city!",
      icon: "error",
      buttons: [
        'NO',
        'YES'
      ],
    }).then(function(isConfirm) {
      if (isConfirm) {
        $('#page-loader').show();
        $.ajax({
          url: "{{route('city.remove')}}",
          data: {
            id: id
          },
          success: function(data) {
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
          error: function(error) {
            $('#page-loader').hide();
          }
        });
      } else {

      }
    });
  });
//on change get cities name 
$('#countries').on('change', function() {
   var country_id=$('#countries').val();
    $.ajax({
    url: "{{route('city.dropdown')}}",
    type: "POST",
    data: {
    country_id: country_id
    },
    cache: false,
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(result){
    console.log(result);
    // $("#city_name").html(result);
    var subcities = '<select class="form-control select2" id="city_name" name="city_name"><option value="N/A" disabled selected="true">--Select City--</option>'; 
    $.each(result, function (key, value) {                     
      subcities += '<option class="form-drop-items" value='+value.city_name+'>'+value.city_name+'</option>';
    });   
    subcities += '</select>'; 
    $("#city_name").html(subcities);  
    }
    });
});
</script>