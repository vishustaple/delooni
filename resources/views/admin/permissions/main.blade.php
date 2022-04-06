<div class="card" id="data">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" style="cursor:pointer" 
                        data-toggle="modal" 
                        data-target="#myModal">Add Permission</a></li>
                                      <!-- The Modal -->
                    <div class="modal" id="myModal"> 
                      <div class="modal-dialog modal-lg" >
                        <div class="modal-content">

                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h4 class="modal-title">Permission</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>

                          <!-- Modal body -->
                          <div class="modal-body">
                          @include('admin.permissions.addform')
                          </div>
                        </div>
                      </div>
                    </div>
                  <!-- <li class="nav-item"><a class="nav-link" href="#view" data-toggle="tab">Add User</a></li> -->
                  <li class="nav-item search-right">
                   <!-- <div>
                      <div class="input-group" data-widget="sidebar-search">
                      <input class="form-control form-control-sidebar" id="search" type="search" placeholder="Search" aria-label="Search">
                      </div>
                   </div> -->
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="view">
                     @include('admin.permissions.view')
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
      </div>
      <script>
 $(document).on('click', '.pagination a', function(event){
 event.preventDefault();
 var page = $(this).attr('href').split('page=')[1];
 var sendurl=$(this).attr('href');
 fetch_data(page,sendurl);
});
function fetch_data(page,url)
{
  let make_url="";
  let value=document.querySelector("#search").value;
  if(url.indexOf('search')> -1){
    make_url="{{url('/')}}/admin/permissions/search?page="+page;
    var data={'search':value};
  }else{
    make_url="{{url('/')}}/admin/permissions/views/fetch_data?page="+page;
    var data="";
  }
 $.ajax({
  url:make_url,
  data:data,
  success:function(data)
  {
   $('#view').empty().html(data);
  }
 });
}


</script>