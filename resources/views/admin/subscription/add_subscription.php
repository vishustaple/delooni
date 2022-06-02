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
          <div class="row w-100 mx-0">
          <div class="col-sm-6 pl-0">
            <div class="form-control">
            <select class="planno select2" id="planno" name="planno">
        <option value="N/A" disabled selected="true">--Select No--</option>
        <?php
        for ($i=1; $i<=60; $i++)
        {
        ?>
        <option value="<?php echo $i;?>" name="planno"><?php echo $i;?></option>
        <?php
        }
        ?>
        </select>
        </div>
        <div class="error" id="error_planno"></div>
      </div>
      <div class="col-sm-6 pr-0">
      <div class="form-control">
      <select class="plan select2" id="plan" name="plan" >
                        <option data-parent="0" disabled selected="true">--Select duration--</option>
                        <option data-parent="1" value="week" name="plan">week</option>
                        <option data-parent="0" value="weeks" name="plan">weeks</option>
                        <option data-parent="1" value="month" name="plan">month</option>
                        <option data-parent="0" value="months" name="plan">months</option>
                        <option data-parent="1" value="year" name="plan">year</option>
                        <option data-parent="0" value="years" name="plan">years</option>
      </select>

      </div>
      <div class="error" id="error_plan"></div>
      </div>
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
      <label for="user_type" class="col-sm-12 col-form-label">User Type</label>
      <div class="col-sm-12 ">
        <div class="form-control select-wrapper">
                 <select class="subscription select2" id="user_type" name="user_type" >
                        <option value="N/A" disabled selected="true">--User Type--</option>
                        <!-- <option value="1" name="user_type">Customer</option> -->
                        <option value="2" name="user_type">Individual Service Provider</option>
                        <option value="3" name="user_type">Company Service Provider</option>
                  </select>
                <div class="error" id="error_user_type">
                </div>
      </div>
      </div>
      </div>

        <div class="form-group row">
      <label for="plan_type" class="col-sm-12 col-form-label">Plan Type</label>
      <div class="col-sm-12 mb-3">
        <div class="form-control select-wrapper">
                 <select class="subscription select2" id="plan_type" name="plan_type" >
                        <option value="N/A" disabled selected="true">--Plan Type--</option>
                        <option value="1" name="plan_type">Ads Plan</option>
                        <option value="2" name="plan_type">TopList Plan</option>
                        <option value="3" name="plan_type">App Access Plan</option>
                  </select>
                <div class="error" id="error_plan_type">
                </div>
      </div>
            </div>
        </div>

    <div class="form-group row ">
        <div class="col-sm-12 text-center">
          <button type="submit" class="btn app-button">Submit</button>
          <button type="reset" class="btn btn-danger">Reset</button>
        </div>
      </div>
    </form>