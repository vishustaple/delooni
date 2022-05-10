@extends('admin.layout.template')
@section('contents')
<div class="card" id="data">
              <div class="card-header p-2 yellow-bg">
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
</script>
@endsection