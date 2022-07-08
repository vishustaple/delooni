<style>
  .pac-container {
 z-index: 10000 !important;
}
</style>
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
        <div class="col-md-6" id="phoneC">
          <label for="phone" class="col-sm-12 col-form-label">Phone</label>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone">
              <input type="hidden"  id="country_code" name ="country_code">  
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
        <div class="col-sm-6">
        <label for="address" class="col-sm-12 col-form-label">Address</label>
        <div class="col-sm-12">
          <input class="form-control" id="address" name="address" placeholder="Enter Address">
          <input type="hidden" id="latitude" name="latitude">
                <input type="hidden" id="longitude" name="longitude">
          <div class="error" id="error_address">
          </div>
        </div>
        </div>
        <div class="col-md-6">
          <label for="Date of Birth" class="col-sm-12 col-form-label">Date of Birth</label>
          <div class="col-sm-12">
              <input type="date" class="form-control" id="dateofbirth" name="dateofbirth"
                  placeholder="Enter Your Date of Birth">
              <div class="error" id="error_dateofbirth">
              </div>
          </div>
      </div>
     </div>
      
         
        <div class="form-group row">
         <div class="col-sm-12">
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

/*country code script*/
const phoneInputField = document.querySelector("#phone");
    const phoneInput = window.intlTelInput(phoneInputField, {
    utilsScript:
    "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    initialCountry: "sa",

    });
</script> 

