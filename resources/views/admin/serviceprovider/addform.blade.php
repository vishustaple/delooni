

<form class="form-horizontal" id="createprovider" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-12 mt-3">
            <h4 class="mb-0">General Details</h4>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="Business_name" class="col-sm-6 col-form-label">Business Name</label>

                <input type="text" class="form-control" id="business_name" name="business_name"
                    placeholder="Enter Your Business Name ">
                <div class="error" id="error_business_name">
                </div>

            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="Firstname" class="col-sm-6 col-form-label">First Name</label>

                <input type="text" class="form-control" id="firstname" name="firstname"
                    placeholder="Enter Your First Name">
                <div class="error" id="error_firstname">
                </div>

            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="Lastname" class="col-sm-6 col-form-label">Last Name</label>

                <input type="text" class="form-control" id="lastname" name="lastname"
                    placeholder="Enter Your Last Name ">
                <div class="error" id="error_lastname">
                </div>

            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="email" class="col-sm-6 col-form-label">Email</label>

                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email ">
                <div class="error" id="error_email">
                </div>

            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="Password" class="col-sm-6 col-form-label">Password</label>
                <input type="Password" class="form-control" id="Password" name="password"
                    placeholder="Enter Your Password">
                <div class="error" id="error_password">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="Password" class="col-sm-6 col-form-label">Confirm Password</label>
                <input type="Password" class="form-control" id="confirm_Password" name="confirm_password"
                    placeholder="Enter Your Password">
                <div class="error" id="error_confirm_password">
                </div>
            </div>
        </div>
    
        <div class="col-md-6">
            <div class="form-group">
                <label>Upload image</label>
                <input type="file" class="form-control" id="img" name="img" accept="image/*">
                <div class="error" id="error_img">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Upload Video(Brief of Service provider)</label>
                <input type="file" class="form-control" id="video" name="video" accept="video/*">
                <div class="error" id="error_video">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="Nationality" class="col-sm-6 col-form-label">Nationality</label>
                <select class="form-control select2" id="nationality" name="nationality">
                <option value="N/A" disabled selected="true">--Select Nationality--</option>
                @foreach($getcountry as $getcountries)
                <option class="form-drop-items" value="{{$getcountries->country_name}}" data-iconurl="{{URL::to('/')}}/flag/{{$getcountries->flag}}">{{$getcountries->country_name}}</option>
                @endforeach
                </select>
                <div class="error" id="error_nationality">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="Address" class="col-sm-6 col-form-label">Address</label>
                <textarea class="form-control" id="address" name="address" placeholder="Enter Your Address "></textarea>
                <div class="error" id="error_address">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="Phone Number" class="col-sm-6 col-form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone" name="phone"
                    placeholder="Enter Your Phone Number ">
                <div class="error" id="error_phone">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="Whatsapp Number" class="col-sm-6 col-form-label">Whatsapp Number</label>
                <input type="text" class="form-control" id="whatsappNumber" name="whatsappNumber"
                    placeholder="Enter Your Whatsapp Number. ">
                <div class="error" id="error_whatsappNumber">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="SnapChat">SnapChat Link</label>
                <input type="url" class="form-control" id="snapchat" name="snapchat"
                    placeholder="Enter Your SnapChat Link">
                <div class="error" id="error_snapchat">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="Instargram">Instagram Link</label>
                <input type="url" class="form-control" id="instagram" name="instagram"
                    placeholder="Enter Your Instagram Link ">
                <div class="error" id="error_instagram">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="Twitter">Twitter Link</label>
                <input type="url" class="form-control" id="twitter" name="twitter"
                    placeholder="Enter Your Twitter Link ">
                <div class="error" id="error_twitter">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="License Number">License Number</label>
                <input type="text" class="form-control" id="licensenumber" name="licensenumber"
                    placeholder="Enter Your License Number ">
                <div class="error" id="error_licensenumber">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>License Photo</label>
                <input type="file" accept="image/*" class="form-control" id="licensephoto" name="licensephoto"
                    placeholder="Enter Your License Photo ">
                <div class="error" id="error_licensephoto">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="Date of Birth">Date of Birth</label>
                <input type="date" class="form-control" id="dateofbirth" name="dateofbirth"
                    placeholder="Enter Your Date of Birth  ">
                <div class="error" id="error_dateofbirth">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="Description">Add Description</label>
                <textarea class="form-control" id="description" name="description"
                    placeholder="Enter Your Description  "></textarea>
                <div class="error" id="error_description">

                </div>
            </div>
        </div>
        
        <div class="col-md-12 my-3">
            <div class="row">
                <div class="col-md-12 mb-2">
                   <h4>Service Details</h4>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="service_category_id" class="col-md-6 col-form-label">Select category </label>
                        <select class="form-control select2" id="service_category_id" name="service_category_id">
                        <option value="N/A" disabled selected="true">--Select category--</option>
                        @foreach($categorynames as $categoryname)
                        <option class="form-drop-items" value="{{$categoryname->id}}">{{$categoryname->name}}</option>
                        @endforeach
                        </select>
                        <div class="error" id="error_service_category_id">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="subcategory" class="col-md-6 col-form-label">Select Sub category </label>
                        <select class="form-control select2" id="subcategory" name="subcategory">
                        <option value="N/A" disabled selected="true">--Select sub category--</option>
                        </select>
                        <div class="error" id="error_subcategory">
                        </div>
                    </div>   
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="price_per_hour" >Service Price(/hours) </label>
                    <input type="text" class="form-control" id="price_per_hour" name="price_per_hour" placeholder="Service Price per hour">
                    <div class="error" id="error_price_per_hour">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="price_per_day" >Service Price(/days)</label>
                    <input type="text" class="form-control" id="price_per_day" name="price_per_day" placeholder="Service Price per day">
                          <div class="error" id="error_price_per_day">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="price_per_month" >Service Price(/month)</label>
                    <input type="text" class="form-control" id="price_per_month" name="price_per_month" placeholder="Service Price per month">
                          <div class="error" id="error_price_per_month">
                         </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-3">
            <div class="row">
                <div class="col-md-12 mb-2">
                   <h4>Education Details</h4>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="education">Enter College/School Name</label>
                        <input type="text" class="form-control" id="education" name="education"
                            placeholder="Enter Your College/School Name ">
                        <div class="error" id="error_education">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="degree">Degree</label>
                        <input type="text" class="form-control" id="degree" name="degree"
                            placeholder="Enter Your College/School Name ">
                        <div class="error" id="error_degree">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="startdate">Start Date</label>
                        <input type="date" class="form-control" id="startdate" name="startdate"
                            placeholder="Enter Your Start Date ">
                        <div class="error" id="error_startdate">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="enddate">End Date</label>
                        <input type="date" class="form-control" id="enddate" name="enddate" placeholder="Enter Your End Date ">
                        <div class="error" id="error_enddate">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mb-3">
            <h4>Work Experience</h4>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="experience">Work Experience</label>
                <input type="text" class="form-control" id="experience" name="experience"
                    placeholder="Enter Your Work Experience ">
                <div class="error" id="error_experience">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="brief_of_experience">Brief Of Experience</label>
               
                <textarea class="form-control" id="brief_of_experience" name="brief_of_experience" placeholder="Enter Your brief of Experience"></textarea>
                <div class="error" id="error_brief_of_experience">
                </div>
            </div>
        </div>
</div>


    <div class="form-group row mt-4">
        <div class="col-sm-12 text-center">
            <button type="submit" class="btn app-button">Submit</button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </div>
    </div>
</form>
