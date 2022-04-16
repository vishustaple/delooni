<div class="card">
              <div class="card-header">
                <h3 class="card-title">Updateuser</h3>
                @include('admin.serviceprovider.back')
              </div>
              <!-- /.card-header -->
             
             <div class="card-body" id="updateUser">
             <form class="form-horizontal" action="{{url('/')}}/updateproviderdata" id="update_user" method="post">
                      @csrf
                      <input type="hidden" name="id" value="{{$data->id}}">
                      <input type="hidden" class="form-control" name="created_by" value="">
                      <div class="form-group row">
                        <label for="businessname" class="col-sm-2 col-form-label">Business Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="businessname" value="{{$data->business_name}}" >
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="firstname" value="{{$data->first_name}}" >
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="lastname" class="col-sm-2 col-form-label">Last Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="lastname" value="{{$data->last_name}}" >
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="email" value="{{$data->email}}" >
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="uploadimage" class="col-sm-2 col-form-label">Uploaded image</label>
                        <div class="col-sm-10">
                          <img src="{{URL::to('/')}}/profile_image/{{$data->profile_image}}">
                          <input type="file" class="form-control" id="img" name="img" accept="image/*">
                         <!-- <input type="text" class="form-control" id="uploadimage" value="{{$data->profile_image}}" readonly>  -->
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="uploadedvideo" class="col-sm-2 col-form-label">Uploaded Video</label>
                        <div class="col-sm-10">
                        <video width="320" height="240" controls>
                           <source src="{{URL::to('/')}}/profile_video/{{$data->profile_video}}" type="video/mp4"></video>
                           <input type="file" class="form-control" id="video" name="video" accept="video/*">
                           <!-- <input type="text" class="form-control" id="uploadedvideo" value="{{$data->profile_video}}" readonly> -->
                        </div>
                      </div>                      
                      <div class="form-group row">
                        <label for="nationality" class="col-sm-2 col-form-label">Nationality</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="nationality" value="{{$data->nationality}}" >
                      </div>
                      </div>
                      <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="address" value="{{$data->address}}" >
                          </div>
                      </div>
                      <div class="form-group row">
                        <label for="phone" class="col-sm-2 col-form-label">Phone Number</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="phone" value="{{$data->phone}}" >
                          </div>
                      </div>
                      <div class="form-group row">
                        <label for="whatsapp" class="col-sm-2 col-form-label">Whatsapp Number</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="whatsapp" value="{{$data->whatsapp_no}}" >
                          </div>
                      </div>
                      <div class="form-group row">
                        <label for="snapchat" class="col-sm-2 col-form-label">SnapChat Link</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="snapchat" value="{{$data->snapchat_link}}" >
                          </div>
                      </div>
                      <div class="form-group row">
                        <label for="instagram" class="col-sm-2 col-form-label">Instagram Link</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="instagram" value="{{$data->instagram_link}}" >
                          </div>
                      </div>
                      <div class="form-group row">
                        <label for="twitter" class="col-sm-2 col-form-label">Twitter Link</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="twitter" value="{{$data->twitter_link}}" >
                          </div>
                      </div>
                      <div class="form-group row">
                        <label for="licenseno" class="col-sm-2 col-form-label">License Number</label>
                        <div class="col-sm-10">
                        <input type="number" class="form-control" id="licenseno" value="{{$data->license_cr_no}}" >
                          </div>
                      </div>
                      <div class="form-group row">
                        <label for="licensephoto" class="col-sm-2 col-form-label">License Photo</label>
                        <div class="col-sm-10">
                        <img src="{{URL::to('/')}}/profile_image/{{$data->license_cr_photo}}">
                        <input type="file" accept="image/*" class="form-control" id="licensephoto" name="licensephoto"
                    placeholder="Enter Your License Photo ">
                   <!-- <input type="text" class="form-control" id="licensephoto" value="{{$data->license_cr_photo}}" readonly> -->
                          </div>
                      </div>
                      <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Add Description</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="description" value="{{$data->description}}" >
                          </div>
                      </div>
                      <div class="form-group row">
                        <label for="dob" class="col-sm-2 col-form-label">Date of Birth</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="dob" value="{{$data->dob}}" >
                          </div>
                      </div>
                      <div class="form-group row">
                        <label for="institutename" class="col-sm-2 col-form-label">College/School Name</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="institutename" value="{{$geteducation->institute_name}}" >
                          </div>
                      </div>
                      <div class="form-group row">
                        <label for="degree" class="col-sm-2 col-form-label">Degree</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="degree" value="{{$geteducation->degree}}" >
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="startdate" class="col-sm-2 col-form-label">Start Date</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="startdate" value="{{$geteducation->start_date}}" >
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="enddate" class="col-sm-2 col-form-label">End Date</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="enddate" value="{{$geteducation->end_date}}" >
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="workexperience" class="col-sm-2 col-form-label"> Work Experience</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="workexperience" value="{{$getwork->no_of_years}}" >
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