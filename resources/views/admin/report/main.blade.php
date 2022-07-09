@extends('admin.layout.template')
@section('contents')
<div class="card" id="data">
               <div class="card-header p-2 yellow-bg">
                <ul class="nav nav-pills">
                <li class="nav-item">
                  <h3 class="card-title mt-2">Report List</h3>
                </li>
                     <!-- The Modal -->
                    <div class="modal" id="myModal"> 
                      <div class="modal-dialog modal-md">
                        <div class="modal-content">
                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h4 class="modal-title"></h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                           <!-- Modal body -->
                          <div class="modal-body">
                          </div>
                        </div>
                      </div>
                    </div>
                 <li class="nav-item search-right">
                   <div>
                      <div class="input-group" data-widget="sidebar-search" autocomplete="off">
                     </div>
                   </div>
                  </li>
                </ul>
              </div>
              <div class="card-body py-0">
                <div class="tab-content">
                  <div class="active tab-pane register-blk export-btn" id="view">
                  @include('admin.report.view')
                 </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
</div>
@endsection