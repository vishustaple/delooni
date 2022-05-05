<form class="form-horizontal"  id="add_service"  method="post"  enctype="multipart/form-data">
      @csrf
      <div class="form-group row">
        <label for="title" class="col-sm-12 col-form-label">Service Name </label>
        <div class="col-sm-12">
          <input type="text" class="form-control" id="title" name="title" placeholder="Enter Service Name">
          <div class="error" id="error_title">
          </div>
        </div>
      </div>
      <div class="form-group row">
        <label for="description" class="col-sm-12 col-form-label">Description </label>
        <div class="col-sm-12">
          <textarea class="form-control" id="description" name="description" placeholder="Enter Description"></textarea>
          <div class="error" id="error_description">
          </div>
        </div>
      </div>
  <div class="form-group row">
        <label class="col-sm-12 col-form-label">Service Category Image </label>
        <div class="col-sm-12">
          <input type="file" class="form-control" id="service_image" name="service_image" placeholder="Upload Service Image">
          <div class="error" id="error_service_image">
          </div>
        </div>
      </div>   
      <div class="form-group row">
      <div class="col-md-4 pl-md-0">
        <label for="price_per_hour" class="col-sm-12 col-form-label">Service Price(/hours) </label>
        <div class="col-sm-12">
          <input type="text" class="form-control" id="price_per_hour" name="price_per_hour" placeholder="Service Price per hour">
          <div class="error" id="error_price_per_hour">
          </div>
        </div>
      </div> 
      <div class="col-md-4">
        <label for="price_per_day" class="col-sm-12 col-form-label">Service Price(/days) </label>
        <div class="col-sm-12">
          <input type="text" class="form-control" id="price_per_day" name="price_per_day" placeholder="Service Price per day">
          <div class="error" id="error_price_per_day">
          </div>
        </div>
      </div> 
      <div class="col-md-4 pr-md-0">
        <label for="price_per_month" class="col-sm-12 col-form-label">Service Price(/month) </label>
        <div class="col-sm-12">
          <input type="text" class="form-control" id="price_per_month" name="price_per_month" placeholder="Service Price per month">
          <div class="error" id="error_price_per_month">
          </div>
        </div>
      </div> 
    </div>
      <div class="form-group row">
        <label for="service_category_id" class="col-sm-12 col-form-label">Select category </label>
        <div class="col-sm-12 form-control">
        <select class="category select2" id="service_category_id"   name="cat_id">
        <option value="N/A" disabled selected="true">--Select category--</option>
        @foreach($categorynames as $categoryname)
      <option class="form-drop-items" value="{{$categoryname->id}}">{{$categoryname->name}}</option>
        @endforeach
        </select>
        <div class="error" id="error_cat_id">
        </div>
        </div>
      </div> 
      <div class="form-group row">
        <label for="subcategory" class="col-sm-12 col-form-label">Select Sub category </label>
        <div class="col-sm-12 form-control">
        <select class="select2" id="subcategory" name="sub_cat_id">
        <option value="N/A" disabled selected="true">--Select sub category--</option>
        </select>
        <div class="error" id="error_subcategory">
        </div>
    </div> 
    </div>
   <div class="form-group row">
        <label for="user_id" class="col-sm-12 col-form-label">Select Serviceprovider </label>
        <div class="col-sm-12 form-control">
        <select class="select2" id="user_id" name="user_id">
        <option value="N/A" disabled selected="true">--Select Serviceprovider--</option>
        @foreach($serviceproviders as $serviceprovider)
      <option class="form-drop-items" value="{{$serviceprovider->id}}">{{$serviceprovider->first_name}} {{$serviceprovider->last_name}}</option>
        @endforeach
        </select>
        <div class="error" id="error_user_id">
        </div>
      </div> 
    </div>
    <div class="form-group row">
        <label for="currency" class="col-sm-12 col-form-label">Currency </label>
        <div class="col-sm-12">
          <input type="text" class="form-control" id="currency" name="currency" placeholder="Currency">
          <div class="error" id="error_currency">
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

                    
           