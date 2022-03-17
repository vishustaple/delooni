
         <form class="form-horizontal" action="" id="createUser" method="post">
                      @csrf
                      <div class="form-group row">
                        <label for="first_name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Name ">
                          <div class="error" id="error_name">
                            <!-- @error('Name'){{$message}}@enderror -->
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">E-mail</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email ">
                          <div class="error" id="error_email">
                            <!-- @error('Email'){{$message}}@enderror -->
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="Password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                          <input type="Password" class="form-control" id="Password" name="password" placeholder="Enter Your Password">
                          <div class="error" id="error_password">
                            <!-- @error('Password'){{$message}}@enderror -->
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
