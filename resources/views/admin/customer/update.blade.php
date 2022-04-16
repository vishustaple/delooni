<form class="form-horizontal"  id="update_customer"  method="post">
                      @csrf
                      <input type="hidden" name="id" id="id" value="{{$categoryData->id}}">
                      <div class="form-group row">
                        <label for="first_name" class="col-sm-2 col-form-label">First Name :</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="first_name" name="first_name" value="{{$categoryData->first_name}}">
                          <div class="error" id="error_first_name">
                         </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="last_name" class="col-sm-2 col-form-label">Last Name :</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="last_name" name="last_name" value="{{$categoryData->last_name}}">
                          <div class="error" id="error_last_name">
                         </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email :</label>
                        <div class="col-sm-9">
                          <input type="email" class="form-control" id="email" name="email" value="{{$categoryData->email}}">
                          <div class="error" id="error_email">
                          </div>
                        </div>
                      </div>
                   <div class="form-group row">
                        <label for="phone" class="col-sm-2 col-form-label">Phone :</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="phone" name="phone" value="{{$categoryData->phone}}">
                          <div class="error" id="error_phone">
                         </div>
                        </div>
                      </div>    
                      <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">Address :</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="address" name="address" value="{{$categoryData->address}}">
                          <div class="error" id="error_address">
                         </div>
                        </div>
                      </div>    
                      <div class="form-group row">
                        <label for="nationality" class="col-sm-2 col-form-label">Nationality :</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="nationality" name="nationality" value="{{$categoryData->nationality}}">
                          <div class="error" id="error_nationality">
                         </div>
                        </div>
                      </div>           
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-success">Submit</button>
                         </div>
                      </div>
                    </form>