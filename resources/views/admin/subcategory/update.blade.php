<form class="form-horizontal"  id="update_subcategory"  method="post"  enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="id"  id="id"  value="{{$categoryDatas->id}}"> 
                      <div class="form-group row">
                        <label for="name" class="col-sm-12 col-form-label">Name</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="name" value="{{$categoryDatas->name}}"  name="name">
                          <div class="error" id="_error_name">
                         </div>
                        </div>
                      </div>
                     <div class="form-group row">
                        <label for="description" class="col-sm-12 col-form-label">Description</label>
                        <div class="col-sm-12">
                          <textarea class="form-control" id="description"  name="description">{{$categoryDatas->description}}</textarea>
                          <div class="error" id="_error_description">
                          </div>
                        </div>
                      </div>
                    <label  class="col-sm-12 col-form-label">Uploaded image</label>
                        <div class="col-sm-12">
                          <img class="lazyload mb-3" src="{{URL::to('/')}}/profile_image/{{$categoryDatas->service_category_image}}">
                          <input type="file" class="form-control" id="service_category_image" name="service_category_image" accept="image/*">
                         <div class="error" id="_error_service_category_image"></div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="is_parent" class="col-sm-12 col-form-label">Select category </label>
                      <div class="col-sm-12 ">
                      <select class="form-control category select2" id="is_parent"   name="is_parent">
                      <option value="N/A" disabled selected="true">--Select category--</option>
                      @foreach($categories as $categorie)
                      <option class="form-drop-items" value="{{$categorie->id}}">{{$categorie->name}}</option>
                       @endforeach
                       </select>
                      <div class="error" id="_error_is_parent">
                       </div>
                       </div>
                        </div> 
                   <div class="form-group row mb-0 mt-4">
                        <div class="col-sm-12 text-center">
                          <button type="submit" class="btn app-button">Submit</button>
                          
                        </div>
                      </div>
                    </form>