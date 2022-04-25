<div class="card">
              <div class="card-header">
                <h3 class="card-title">Updateuser</h3>
                @include('admin.serviceprovider.back')
              </div>
              <!-- /.card-header -->
             
             <div class="card-body" id="updateUser">
             <form class="form-horizontal" action="{{url('/')}}/updateproviderdata" id="update_provider" method="post">
                      @csrf
                      <input type="hidden" name="id" value="">
                      <input type="hidden" class="form-control" name="created_by" value="">
                      <div class="form-group row">
                        <label for="businessname" class="col-sm-2 col-form-label">Business Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="businessname" name="business_name" value="" >
                          <div class="error" id="error_business_name"></div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="firstname" name="firstname" value="" >
                          <div class="error" id="error_firstname"></div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="lastname" class="col-sm-2 col-form-label">Last Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="lastname"  name="lastname" value="" >
                          <div class="error" id="error_lastname"></div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="email" name="email" value="" >
                          <div class="error" id="error_email"></div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="uploadimage" class="col-sm-2 col-form-label">Uploaded image</label>
                        <div class="col-sm-10">
                        
                          <input type="file" class="form-control" id="img" name="img" accept="image/*">
                         <div class="error" id="error_img"></div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="uploadedvideo" class="col-sm-2 col-form-label">Uploaded Video</label>
                        <div class="col-sm-10">
                        <video width="320" height="240" controls>
                          
                           <input type="file" class="form-control" id="video" name="video" accept="video/*">

                       <div class="error" id="error_video"></div>
                      </div>
                      </div>                      
                      <div class="form-group row">
                        <label for="nationality" class="col-sm-2 col-form-label">Nationality</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="nationality" name="nationality" value="" >
                        <div class="error" id="error_nationality"></div>
                      </div>
                      </div>
                      <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="address" name="Address" value="" >
                        <div class="error" id="error_Address"> </div> 
                      </div>
                      </div>
                      <div class="form-group row">
                        <label for="phone" class="col-sm-2 col-form-label">Phone Number</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="phone" name="phone" value="" >
                        <div class="error" id="error_phone">   </div> 
                      </div>
                      </div>
                      <div class="form-group row">
                        <label for="whatsapp" class="col-sm-2 col-form-label">Whatsapp Number</label>
                        <div class="col-sm-10"> 
                       <input type="text" class="form-control" id="whatsapp" name="whatsappNumber" value="" >
                       <div class="error" id="error_whatsappNumber"></div>
                      </div>
                      </div>
                      <div class="form-group row">
                        <label for="snapchat" class="col-sm-2 col-form-label">SnapChat Link</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="snapchat" name="snapchat" value="" >
                        <div class="error" id="error_snapchat"></div>
                      </div>
                      </div>
                      <div class="form-group row">
                        <label for="instagram" class="col-sm-2 col-form-label">Instagram Link</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="instagram" name="instagram" value="" >
                        <div class="error" id="error_instagram"></div>
                      </div>
                      </div>
                      <div class="form-group row">
                        <label for="twitter" class="col-sm-2 col-form-label">Twitter Link</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="twitter" name="twitter" value=""  >
                        <div class="error" id="error_twitter"></div>
                      </div>
                      </div>
                      <div class="form-group row">
                        <label for="licenseno" class="col-sm-2 col-form-label">License Number</label>
                        <div class="col-sm-10">
                        <input type="number" class="form-control" id="licenseno" name="licensenumber" value="" >
                        <div class="error" id="error_licensenumber"></div>
                      </div>
                      </div>
                      <div class="form-group row">
                        <label for="licensephoto" class="col-sm-2 col-form-label">License Photo</label>
                        <div class="col-sm-10">
                        
                        <input type="file" accept="image/*" class="form-control" id="licensephoto" name="licensephoto"
                    placeholder="Enter Your License Photo ">
                   <!-- <input type="text" class="form-control" id="licensephoto" value="{{$data->license_cr_photo}}" readonly> -->
                   <div class="error" id="error_licensephoto"> </div>
                  </div>
                      </div>
                      <div class="form-group row">
                        <label for="dob" class="col-sm-2 col-form-label">Date of Birth</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="dob" name="dateofbirth" value="" >
                        <div class="error" id="error_dateofbirth"></div>
                      </div>
                      </div>
                      <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Add Description</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="description" name="description" value="" >
                        <div class="error" id="error_description"></div>
                      </div>
                      </div>
                      <!--service detail strat-->
                      <div class="col-md-6">
                      <div class="form-group">
                        <label for="service_category_id" class="col-md-6 col-form-label">Select Services :</label>
                     
                        <div class="error" id="error_service_services">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="service_category_id" class="col-md-6 col-form-label">Select category :</label>
                        <div class="error" id="error_service_category_id">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="subcategory" class="col-md-6 col-form-label">Select Sub category :</label>
                        <select class="form-control select2" id="subcategory" name="subcategory">
                        <option value="N/A" disabled selected="true">--Select sub category--</option>
                        </select>
                        <div class="error" id="error_subcategory">
                        </div>
                    </div>   
                </div>
                      <!---->
                      <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label"> Services</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="description" name="description" value="" >
                        <div class="error" id="error_description"></div>
                      </div>
                      </div>
                      <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label"> category</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="description" name="description" value="" >
                        <div class="error" id="error_description"></div>
                      </div>
                      </div>
                      <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Sub category</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="description" name="description" value="" >
                        <div class="error" id="error_description"></div>
                      </div>
                      </div>
                      <div class="form-group row">
                        <label for="price_per_hour" class="col-sm-2 col-form-label">Service Price(/hours)</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="price_per_hour" name="price_per_hour" value="" >
                        <div class="error" id="error_price_per_hour"></div>
                      </div>
                      </div>
                      <div class="form-group row">
                        <label for="price_per_day" class="col-sm-2 col-form-label">Service Price(/days) </label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="price_per_day" name="price_per_day" value="" >
                        <div class="error" id="error_price_per_day"></div>
                      </div>
                      </div>
                      <div class="form-group row">
                        <label for="price_per_month" class="col-sm-2 col-form-label">Service Price(/month)</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="price_per_month" name="price_per_month" value="" >
                        <div class="error" id="error_price_per_month"></div>
                      </div>
                      </div>


                      <!--service detail end-->
                      <div class="form-group row">
                        <label for="institutename" class="col-sm-2 col-form-label">College/School Name</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="institutename" name="education" value="" >
                        <div class="error" id="error_education"> </div>
                      </div>
                      </div>
                      <div class="form-group row">
                        <label for="degree" class="col-sm-2 col-form-label">Degree</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="degree" name="degree" value="" >
                        <div class="error" id="error_degree"></div>
                      </div>
                      </div>
                      <div class="form-group row">
                        <label for="startdate" class="col-sm-2 col-form-label">Start Date</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="startdate" name="startdate" value="" >
                        <div class="error" id="error_startdate"></div>
                      </div>
                      </div>
                      <div class="form-group row">
                        <label for="enddate" class="col-sm-2 col-form-label">End Date</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="enddate" name="enddate" value="" >
                        <div class="error" id="error_enddate"></div>
                      </div>
                      </div>
                      <div class="form-group row">
                        <label for="workexperience" class="col-sm-2 col-form-label"> Work Experience</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="workexperience" name="experience" value="" >
                        <div class="error" id="error_experience"></div>  
                      </div>
                      </div>
                      <div class="form-group row">
                        <label for="brief_of_experience" class="col-sm-2 col-form-label">Brief Of Experience</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="brief_of_experience" name="brief_of_experience" value="" >
                        <div class="error" id="error_brief_of_experience"></div>  
                      </div>
                      </div>
                     
                     
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-success">Update</button>
                          <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                      </div>
                </form>
                </div>
</div>
<script>
// $("#update_user").on('submit',(e)=>{
//     e.preventDefault();
    
//     const value=getformvalue("update_user");
//     UserAjax('post','/admin/user/update/',value);
// });


</script>