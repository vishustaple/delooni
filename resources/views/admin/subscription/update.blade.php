<form class="form-horizontal" id="update_subscription" method="post">
  @csrf
  <input type="hidden" name="id" id="id" value="{{$content->id}}">
  <div class="form-group row">
    <label for="plan_name" class="col-sm-12 col-form-label">Plan name</label>
    <div class="col-sm-12">
      <input type="text" class="form-control" id="plan_name" name="plan_name" value="{{$content->plan_name}}">
      <div class="error" id="_error_plan_name">
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="description" class="col-sm-12 col-form-label">Description</label>
    <div class="col-sm-12">
      <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter Description">{{$content->description}}</textarea>
      <div class="error" id="_error_description">
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="validity" class="col-sm-12 col-form-label">Plan validity </label>
    <div class="col-sm-12">
      <div class="row w-100 mx-0">
        <div class="col-sm-6 pl-0">
          <div class="select-wrapper">
            <select class="form-control planno select2" id="planno" name="planno">
              <option value="N/A" disabled selected="true">--Select No--</option>
              <?php
              for ($i = 1; $i <= 60; $i++) {
              ?>
                <option {{ ($validity_no) == $i ? 'selected' : '' }} value="<?php echo $i; ?>" name="planno"><?php echo $i; ?></option>
              <?php
              }
              ?>
            </select>
          </div>
        </div>
        <div class="col-sm-6 pr-0">
          <div class="select-wrapper">
            <select class="form-control plan select2" id="plan" name="plan">
              <option value="N/A" disabled selected="true">--Select duration--</option>
              <option {{  ($validity_duration) == 'week' ? 'selected' : '' }} value="week" name="plan">week</option>
              <option {{  ($validity_duration) == 'weeks' ? 'selected' : '' }} value="weeks" name="plan">weeks</option>
              <option {{  ($validity_duration) == 'month' ? 'selected' : '' }} value="month" name="plan">month</option>
              <option {{  ($validity_duration) == 'months' ? 'selected' : '' }} value="months" name="plan">months</option>
              <option {{  ($validity_duration) == 'year' ? 'selected' : '' }} value="year" name="plan">year</option>
              <option {{  ($validity_duration) == 'years' ? 'selected' : '' }} value="years" name="plan">years</option>
            </select>
          </div>
        </div>
      </div>
      <div class="error" id="error_plan">
        <div class="error" id="error_planno">
        </div>
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="price_per_plan" class="col-sm-12 col-form-label">Price per plan</label>
    <div class="col-sm-12">
      <input type="text" class="form-control" id="price_per_plan" name="price_per_plan" value="{{$content->price_per_plan}}">
      <div class="error" id="_error_price_per_plan">
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="user_type" class="col-sm-12 col-form-label">User Type</label>
    <div class="col-sm-12">
      <div class="select-wrapper">
        <select class="form-control subscription select2" id="user_type" name="user_type">
          <option value="N/A" disabled selected="true">--User Type--</option>
          <option {{  ($content->user_type) == '1' ? 'selected' : '' }} value="1" name="user_type">Customer</option>
          <option {{  ($content->user_type) == '2' ? 'selected' : '' }} value="2" name="user_type">Individual Service Provider</option>
          <option {{  ($content->user_type) == '3' ? 'selected' : '' }} value="3" name="user_type">Company Service Provider</option>
        </select>
        <div class="error" id="error_user_type">
        </div>
      </div>
    </div>
  </div>

  <div class="form-group row">
    <label for="plan_type" class="col-sm-12 col-form-label">Plan Type</label>
    <div class="col-sm-12 ">
      <div class="select-wrapper">
        <select class="form-control subscription select2 " id="plan_type" name="plan_type">
          <option value="N/A" disabled selected="true">--Plan Type--</option>
          <option {{  ($content->plan_type) == '1' ? 'selected' : '' }} value="1" name="plan_type">Ads Plan</option>
          <option {{  ($content->plan_type) == '2' ? 'selected' : '' }} value="2" name="plan_type">TopList Plan</option>
          <option {{  ($content->plan_type) == '3' ? 'selected' : '' }} value="3" name="plan_type">App Access Plan</option>
        </select>
        <div class="error" id="error_plan_type">
        </div>
      </div>
    </div>
  </div>

  
  <div class="form-group row">
    <div class="col-sm-12 text-center">
      <button type="submit" class="btn app-button">Submit</button>

    </div>
  </div>
</form>