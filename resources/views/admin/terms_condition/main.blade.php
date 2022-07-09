@extends('admin.layout.template')
@section('contents')
<div class="card" id="data">
              <div class="card-header p-3 yellow-bg">
                <ul class="nav nav-pills">
                <li class="nav-item"><h3 class="card-title">Terms and Conditions</h3></li>
                
                  <li class="nav-item search-right">
                   <div>
                      <div class="input-group" data-widget="sidebar-search" autocomplete="off">
                      
                      </div>
                   </div>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="view">
                     @include('admin.terms_condition.view')
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
      </div>
  <script>
  $(document).on('click', '.update', function(event){
  $('#page-loader').show();
   $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var id = $(this).attr('data-id');
  $.ajax({
        url:'{{route("condition.view.update")}}',
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
  $(document).on('submit','#condition_update', function(e){
  e.preventDefault();
  var data = new FormData(this);
  console.log(data);
  $.ajax({
    type:'post',
    url:"{{route('condition.update')}}",
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

    </script>
      @endsection