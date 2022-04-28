<form class="form-horizontal"  id="add_subscription"  method="post">
    <div class="form-group row">
        <label for="plan_name" class="col-sm-12 col-form-label">Plan name </label>
        <div class="col-sm-12">
          <input type="text" class="form-control" id="plan_name" name="plan_name" placeholder="Enter Plan">
          <div class="error" id="error_plan_name">
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
        <label for="validity" class="col-sm-12 col-form-label">Plan validity </label>
        <div class="col-sm-12">
          <input type="text" class="form-control" id="validity" name="validity" placeholder="Enter Plan Validity">
          <div class="error" id="error_validity">
          </div>
        </div>
      </div>  
      <div class="form-group row">
        <label for="price_per_plan" class="col-sm-12 col-form-label">Price per plan </label>
        <div class="col-sm-12">
          <input type="text" class="form-control" id="price_per_plan" name="price_per_plan" placeholder="Price per plan">
          <div class="error" id="error_price_per_plan">
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