<form class="form-horizontal"  id="add_customers" method="post">
                      @csrf
                      <div class="form-group row">
                        <label for="first_name" class="col-sm-3 col-form-label">First Name :</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter first name">
                          <div class="error" id="error_first_name">
                         </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="last_name" class="col-sm-3 col-form-label">Last Name :</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter last name">
                          <div class="error" id="error_last_name">
                         </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email :</label>
                        <div class="col-sm-8">
                          <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email ">
                          <div class="error" id="error_email">
                          </div>
                        </div>
                      </div>
                     <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">Password :</label>
                        <div class="col-sm-8">
                          <input type="Password" class="form-control" id="password" name="password" placeholder="Enter Your Password">
                          <div class="error" id="error_password">
                         </div>
                        </div>
                      </div>    
                      <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">Confirm Password :</label>
                        <div class="col-sm-8">
                          <input type="Password" class="form-control" id="password" name="password" placeholder="Enter Your Password">
                          <div class="error" id="error_confirm_password">
                         </div>
                        </div>
                      </div> 
                      <div class="form-group row">
                        <label for="phone" class="col-sm-3 col-form-label">Phone :</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone">
                          <div class="error" id="error_phone">
                         </div>
                        </div>
                      </div>    
                      <div class="form-group row">
                        <label for="address" class="col-sm-3 col-form-label">Address :</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address">
                          <div class="error" id="error_address">
                         </div>
                        </div>
                      </div>    
                      <div class="form-group row">
                        <label for="nationality" class="col-sm-3 col-form-label">Nationality :</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="nationality" name="nationality" placeholder="Enter Nationality">
                          <div class="error" id="error_nationality">
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