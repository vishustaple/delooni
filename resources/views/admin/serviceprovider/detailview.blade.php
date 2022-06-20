
@extends('admin.layout.template')
@section('contents')
<div id="users_data">
<div class="card">
              <div class="card-header yellow-bg">
                <div class="row align-items-center">
                  <div class="col-md-6">
                    <h3 class="card-title">Service Provider User</h3>
                  </div>
                  @include('admin.serviceprovider.back')
               </div>
              </div>
              <!-- /.card-header -->
             <div class="card-body">
              
                      <div class="form-group row">
                        <label for="businessname" class="col-sm-12 col-form-label">Business Name</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="businessname" value="{{$data->business_name}}" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-md-6">
                          <label for="first_name" class="col-sm-12 col-form-label">First Name</label>
                          <div class="col-sm-12">
                            <input type="text" class="form-control" id="firstname" value="{{$data->first_name}}" readonly>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <label for="lastname" class="col-sm-12 col-form-label">Last Name</label>
                          <div class="col-sm-12">
                            <input type="text" class="form-control" id="lastname" value="{{$data->last_name}}" readonly>
                          </div>
                        </div>
                       
                      </div>
                     
                      <div class="form-group row">
                        <label for="email" class="col-sm-12 col-form-label">Email</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="email" value="{{$data->email}}" readonly>
                        </div>
                      </div>
                      <div class="form-group row uploadimage">
                        <label for="uploadimage" class="col-sm-12 col-form-label">Uploaded image</label>
                        <div class="col-sm-12">
                          <img src="{{URL::to('/')}}/profile_image/{{$data->profile_image}}">
                          <!-- <input type="text" class="form-control" id="uploadimage" value="{{$data->profile_image}}" readonly> -->
                        </div>
                      </div>
                      <div class="form-group row uploadimage">
                        <label for="uploadedvideo" class="col-sm-12 col-form-label">Uploaded Video</label>
                        <div class="col-sm-12">
                        <video width="320" height="240" controls>
                           <source src="{{URL::to('/')}}/profile_video/{{$data->profile_video}}" type="video/mp4"></video>
                          <!-- <input type="text" class="form-control" id="uploadedvideo" value="{{$data->profile_video}}" readonly> -->
                        </div>
                      </div>                      
                      <div class="form-group row">
                        <label for="nationality" class="col-sm-12 col-form-label">Nationality</label>
                        <div class="col-sm-12">
                        <input type="text" class="form-control" id="nationality" value="{{$data->nationality}}" readonly>
                          </div>
                      </div>
                      <div class="form-group row">
                        <label for="address" class="col-sm-12 col-form-label">Address</label>
                        <div class="col-sm-12">
                        <textarea type="text" class="form-control" id="address" readonly>{{$data->address}}</textarea>
                          </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-md-6">
                          <label for="phone" class="col-sm-12 col-form-label">Phone Number</label>
                            <div class="col-sm-12">
                              <input type="text" class="form-control" id="phone" value="{{$data->phone}}" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="whatsapp" class="col-sm-12 col-form-label">Whatsapp Number</label>
                            <div class="col-sm-12">
                            <input type="text" class="form-control" id="whatsapp" value="{{$data->whatsapp_no}}" readonly>
                          </div>
                        </div>
                        
                      </div>
                      
                      <div class="form-group row">
                        <div class="col-md-4">
                          <label for="snapchat" class="col-sm-12 col-form-label">SnapChat Link</label>
                            <div class="col-sm-12">
                             <input type="text" class="form-control" id="snapchat" value="{{$data->snapchat_link}}" readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                          <label for="instagram" class="col-sm-12 col-form-label">Instagram Link</label>
                            <div class="col-sm-12">
                             <input type="text" class="form-control" id="instagram" value="{{$data->instagram_link}}" readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                        <label for="twitter" class="col-sm-12 col-form-label">Twitter Link</label>
                        <div class="col-sm-12">
                        <input type="text" class="form-control" id="twitter" value="{{$data->twitter_link}}" readonly>
                          </div>
                        </div>
                        
                      </div>

                      <div class="form-group row">
                        <label for="licenseno" class="col-sm-12 col-form-label">License Number</label>
                        <div class="col-sm-12">
                        <input type="number" class="form-control" id="licenseno" value="{{$data->license_cr_no}}" readonly>
                          </div>
                      </div>
                      <div class="form-group row uploadimage">
                        <label for="licensephoto" class="col-sm-12 col-form-label">License Photo</label>
                        <div class="col-sm-12">
                        <img src="{{URL::to('/')}}/profile_image/{{$data->license_cr_photo}}">
                        <!-- <input type="text" class="form-control" id="licensephoto" value="{{$data->license_cr_photo}}" readonly> -->
                          </div>
                      </div>
                      <div class="form-group row">
                        <label for="dob" class="col-sm-12 col-form-label">Date of Birth</label>
                        <div class="col-sm-12">
                        <input type="text" class="form-control" id="dob" value="{{$data->dob}}" readonly>
                          </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="service_provider_type" class="col-sm-12 col-form-label">Service Provider Type</label>
                        <div class="col-sm-12">
                        <input type="text" class="form-control" id="service_provider_type" value="{{$data->service_provider_type}}" readonly>
                         </div>
                      </div>
                      <div class="form-group row">
                        <label for="description" class="col-sm-12 col-form-label">Add Description</label>
                        <div class="col-sm-12">
                        <textarea class="form-control" id="description"  readonly>{{$data->description}}</textarea>
                          </div>
                      </div>
                   <div class="form-group row">
                        <label for="Category" class="col-sm-12 col-form-label">Category</label>
                        <div class="col-sm-12">
                        <input type="text" class="form-control" id="category" value="{{$getcatgory->name}}" readonly>
                          </div>
                      </div>
                      <div class="form-group row">
                        <label for="subcategory" class="col-sm-2 col-form-label">Service </label>
                        <div class="col-sm-12">
                        <input type="text" class="form-control" id="category" value="{{$servicename->name}}" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                         <div class="col-md-4">
                            <label for="price_per_hour" class="col-sm-12 col-form-label">Service Price(/hours)</label>
                            <div class="col-sm-12">
                               <input type="text" class="form-control" id="price_per_hour" value="{{$data->price_per_hour}}" readonly>
                            </div>
                         </div>

                         <div class="col-md-4">
                         <label for="price_per_day" class="col-sm-12 col-form-label">Service Price(/days)</label>
                            <div class="col-sm-12">
                            <input type="text" class="form-control" id="price_per_day" value="{{$data->price_per_day}}" readonly>
                              </div>
                          </div>

                           <div class="col-md-4">
                           <label for="price_per_month" class="col-sm-12 col-form-label">Service Price(/month)</label>
                            <div class="col-sm-12">
                            <input type="text" class="form-control" id="price_per_month" value="{{$data->price_per_month}}" readonly>
                              </div>
                           </div>
                      
                      </div>


                       <!--servicedetail end-->
                      <div class="form-group row">
                        <label for="institutename" class="col-sm-12 col-form-label">College/School Name</label>
                        <div class="col-sm-12">
                        <input type="text" class="form-control" id="institutename" value="{{$geteducation->institute_name}}" readonly>
                          </div>
                      </div>
                      <div class="form-group row">
                        <label for="degree" class="col-sm-12 col-form-label">Degree</label>
                        <div class="col-sm-12">
                        <input type="text" class="form-control" id="degree" value="{{$geteducation->degree}}" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="startdate" class="col-sm-12 col-form-label">Start Date</label>
                        <div class="col-sm-12">
                        <input type="text" class="form-control" id="startdate" value="{{$geteducation->start_date}}" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="enddate" class="col-sm-12 col-form-label">End Date</label>
                        <div class="col-sm-12">
                        <input type="text" class="form-control" id="enddate" value="{{$geteducation->end_date}}" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="workexperience" class="col-sm-12 col-form-label"> Work Experience</label>
                        <div class="col-sm-12">
                        <input type="text" class="form-control" id="workexperience" value="{{$getwork->no_of_years}}" readonly>
                        </div>
                      </div>
                     
                      <div class="form-group row">
                        <label for="brief_of_experience" class="col-sm-12 col-form-label">Brief of Experience</label>
                        <div class="col-sm-12">
                        <input type="text" class="form-control" id="brief_of_experience" value="{{$getwork->brief_of_experience}}" readonly>
                        </div>
                      </div>
                      </div>
                     
                      </div>
                      <div class="card">
                      @if(count($rating)>0)

                      <div class="card-header yellow-bg">
                      <div class="row align-items-center">
                      <div class="col-md-6">
                      <h3 class="card-title">Rating</h3>
                      </div>
                      </div>
                      </div>
                      <table class="table table-bordered">
                      <thead>
                      <tr>
                      <th style="width: 10px">#</th>
                      <th>Customer Name</th>
                      <th>Rating</th>
                      <th>Message</th>
                      </tr>
                      </thead>
                      @else
                        <div class="card-header yellow-bg">
                      <div class="row align-items-center">
                      <div class="col-md-6">
                      <h3 class="card-title">Provider has no Rating.</h3>
                      </div>
                      </div>
                      </div>
                      
                      @endif
                      <tbody>
                      @forelse($rating as $key=>$value)
                      <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$value->fromuser->first_name}}</td>
                      <td>{{$value->rating}}</td>
                      <td> {{$value->message}}</td>
                      </tr>
                      @empty
                      @endforelse

                      </tbody>
                      </table>     

                      </div>
                      </div>
</div>

</div>
@endsection