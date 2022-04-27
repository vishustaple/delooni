<form class="form-horizontal"  id="update_subscription"  method="post">
                      @csrf
                      <input type="hidden" name="id" id="id" value="{{$content->id}}">
                    <div class="form-group row">
                        <label for="plan_name" class="col-sm-3 col-form-label">Plan name :</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="plan_name" name="plan_name" value="{{$content->plan_name}}">
                          <div class="error" id="error_plan_name">
                         </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label">Description :</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="description" name="description" value="{{$content->description}}">
                          <div class="error" id="error_description">
                          </div>
                        </div>
                      </div>
                 <div class="form-group row">
                        <label for="validity" class="col-sm-3 col-form-label">Plan validity :</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="validity" name="validity" value="{{$content->validity}}">
                          <div class="error" id="error_validity">
                         </div>
                        </div>
                      </div>  
                      <div class="form-group row">
                        <label for="price_per_plan" class="col-sm-3 col-form-label">Price per plan :</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="price_per_plan" name="price_per_plan" value="{{$content->price_per_plan}}">
                          <div class="error" id="error_price_per_plan">
                         </div>
                        </div>
                      </div> 
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-success">Submit</button>
                          <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                      </div>
                    </form>