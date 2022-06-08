<form class="form-horizontal"  id="add_subcategory"  method="post"  enctype="multipart/form-data">
                      @csrf
                      <div class="form-group row">
                        <label for="name" class="col-sm-12 col-form-label">Name</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="name" name="name" placeholder="Enter Service Name">
                          <div class="error" id="error_name">
                         </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="description" class="col-sm-12 col-form-label">Description </label>
                        <div class="col-sm-12">
                          <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter Description"></textarea>
                          <div class="error" id="error_description">
                          </div>
                        </div>
                      </div>
                       <div class="form-group row">
                        <label  class="col-sm-12 col-form-label">Service Image </label>
                        <div class="col-sm-12">
                          <input type="file" class="form-control" id="service_category_image" name="service_category_image" placeholder="Upload Service Category Image">
                          <div class="error" id="error_service_category_image">
                          </div>
                        </div>
                      </div>
                       <div class="form-group row">
                      <label for="is_parent" class="col-sm-12 col-form-label">Select category </label>
                      <div class="col-sm-12 ">
                        <div class="form-control">
                      <select class="category select2" id="is_parent"   name="is_parent">
                      <option value="N/A" disabled selected="true">--Select category--</option>
                      @foreach($categories as $categorie)
                      <option class="form-drop-items" value="{{$categorie->id}}">{{$categorie->name}}</option>
                       @endforeach
                       </select>
                     
                       </div>
                       <div class="error" id="error_is_parent">
                       </div>
                        </div> 
                        
                        </div>
                       <div class="form-group row">
                        <div class="col-sm-12 text-center">
                          <button type="submit" class="btn app-button">Submit</button>
                          <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                      </div>
                    </form>
                