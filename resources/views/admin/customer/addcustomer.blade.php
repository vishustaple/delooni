
<form class="form-horizontal"  id="add_customers" method="post">
      @csrf
      <div class="form-group row">
        <div class="col-md-6">
          <label for="first_name" class="col-sm-12 col-form-label">First Name</label>
          <div class="col-sm-12">
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter first name">
            <div class="error" id="error_first_name">
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <label for="last_name" class="col-sm-12 col-form-label">Last Name</label>
          <div class="col-sm-12">
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter last name">
            <div class="error" id="error_last_name">
            </div>
          </div>
        </div>
    
      </div>


      <div class="form-group row">
        <div class="col-md-6">
          <label for="phone" class="col-sm-12 col-form-label">Phone</label>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone">
              <div class="error" id="error_phone">
              </div>
            </div>
        </div>
        <div class="col-md-6">
        <label for="email" class="col-sm-12 col-form-label">Email</label>
        <div class="col-sm-12">
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email ">
          <div class="error" id="error_email">
          </div>
        </div>
       </div>
      </div>


      <div class="form-group row">
        <div class="col-md-6">
        <label for="password" class="col-sm-12 col-form-label">Password</label>
          <div class="col-sm-12">
            <input type="Password" class="form-control" id="password" name="password" placeholder="Enter Your Password">
            <div class="error" id="error_password">
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <label for="confirm_password" class="col-sm-12 col-form-label">Confirm Password</label>
          <div class="col-sm-12">
            <input type="Password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter Your Password">
            <div class="error" id="error_confirm_password">
            </div>
          </div>
         </div>
        
      </div>    

    
      <div class="form-group row">
        <label for="address" class="col-sm-12 col-form-label">Address</label>
        <div class="col-sm-12">
          <textarea class="form-control" id="address" name="address" placeholder="Enter Address"></textarea>
          <div class="error" id="error_address">
          </div>
        </div>
     </div>
      
         
        <div class="form-group row">
          <label class="col-sm-12 col-form-label">Nationality</label>
          <div class="col-sm-12">
            <div class="form-control">
          <select class="select2" id="nationality" name="nationality">
            <option value="N/A" disabled selected="true">--Select country--</option>
            @foreach($countries as $countrie)
                <option class="form-drop-items" value="{{$countrie->country_name}}">{{$countrie->country_name}}</option>
            @endforeach
            </select>
            <div class="error" id="error_country_name"></div>
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
    <script> 
$(document).ready(function () {
var autocomplete = new google.maps.places.Autocomplete($("#address")[0], {});
google.maps.event.addListener(autocomplete, 'place_changed', function() {
var place = autocomplete.getPlace();
$('#latitude').val(place.geometry.location.lat());
$('#longitude').val(place.geometry.location.lng());
});
});
</script> 

