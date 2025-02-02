<form class="form-horizontal"  id="update_customer"  method="post">
    @csrf
    <input type="hidden" name="id" id="id" value="{{$categoryData->id}}">
    <div class="form-group row">
      <div class="col-md-6">
        <label for="first_name" class="col-sm-12 col-form-label">First Name</label>
          <div class="col-sm-12">
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{$categoryData->first_name}}">
            <div class="error" id="_error_first_name">
            </div>
          </div>
      </div>

      <div class="col-md-6">
        <label for="last_name" class="col-sm-12 col-form-label">Last Name</label>
        <div class="col-sm-12">
          <input type="text" class="form-control" id="last_name" name="last_name" value="{{$categoryData->last_name}}">
          <div class="error" id="_error_last_name">
          </div>
        </div>
      </div>

    </div>
   
    <div class="form-group row">
      <div class="col-md-6">
        <label for="email" class="col-sm-12 col-form-label">Email</label>
        <div class="col-sm-12">
          <input type="email" class="form-control" id="email" name="email" value="{{$categoryData->email}}">
          <div class="error" id="_error_email">
          </div>
        </div>
      </div>

      <div class="col-md-6">
         <label for="phone" class="col-sm-12 col-form-label">Phone</label>
        <div class="col-sm-12">
          <input type="text" class="form-control" id="phone1" name="phone" value="{{$categoryData->phone}}">
          <input type="hidden"  id="country_code" name ="country_code">  
          <div class="error" id="_error_phone">
          </div>
        </div>
      </div>
     
    </div>
    
    <div class="form-group row">
      <label for="address" class="col-sm-12 col-form-label">Address</label>
      <div class="col-sm-12">
        <textarea type="text" class="form-control" id="address" name="address" >{{$categoryData->address}}</textarea>
        <div class="error" id="_error_address">
        </div>
      </div>
    </div>    
    <div class="form-group row">
      <label for="dob" class="col-sm-12 col-form-label">Date of Birth</label>
      <div class="col-sm-12">
      <input type="date" class="form-control" id="dob" name="dateofbirth" value="{{$categoryData->dob}}" >
      <div class="error" id="error_dateofbirth"></div>
    </div>
    </div>
    <div class="form-group row">
          <label class="col-sm-12 col-form-label">Nationality</label>
          <div class="col-sm-12">
            
          <select class="select2 form-control" id="nationality" name="nationality">
            <option value="N/A" disabled selected="true">--Select country--</option>
            @foreach($getcountry as $countrie)
                <option class="form-drop-items" {{  ($categoryData->nationality) == $countrie->country_name ? 'selected' : '' }} value="{{$countrie->country_name}}">{{$countrie->country_name}}</option>
            @endforeach
            </select>
            <div class="error" id="error_nationality"></div>
            
        </div>
      </div>                  
    <div class="form-group row">
      <div class="col-sm-12 text-center">
        <button type="submit" class="btn app-button">Submit</button>
        </div>
    </div>
  </form>
  <script>

    /*country code script*/
    const phoneInputField = document.querySelector("#phone1");
    const phoneInput = window.intlTelInput(phoneInputField, {
    utilsScript:
    "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    initialCountry: "sa",
    });
    </script>