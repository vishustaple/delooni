

<form class="form-horizontal" id="createprovider" method="post" enctype="multipart/form-data">
    @csrf

    <div class="row">
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
                <label for="img">Upload image:</label>
                <input type="file" class="form-control" id="img" name="img" accept="image/*">
                <div class="error" id="error_img">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="img">Upload Video(Brief of Service provider):</label>
                <input type="file" class="form-control" id="video" name="video" accept="video/*">
                <div class="error" id="error_video">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="Nationality" class="col-sm-6 col-form-label">Nationality</label>
                <input type="text" class="form-control" id="nationality" name="nationality"
                    placeholder="Enter Your Nationality ">
                <div class="error" id="error_nationality">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="Address" class="col-sm-6 col-form-label">Address</label>
                <input type="text" class="form-control" id="Address" name="Address" placeholder="Enter Your Address ">
                <div class="error" id="error_Address">
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
                <label for="SnapChat">SnapChat Link:</label>
                <input type="url" class="form-control" id="snapchat" name="snapchat"
                    placeholder="Enter Your SnapChat Link ">
                <div class="error" id="error_snapchat">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="Instargram">Instagram Link:</label>
                <input type="url" class="form-control" id="instagram" name="instagram"
                    placeholder="Enter Your Instagram Link ">
                <div class="error" id="error_instagram">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="Twitter">Twitter Link:</label>
                <input type="url" class="form-control" id="twitter" name="twitter"
                    placeholder="Enter Your Twitter Link ">
                <div class="error" id="error_twitter">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="License Number">License Number:</label>
                <input type="text" class="form-control" id="licensenumber" name="licensenumber"
                    placeholder="Enter Your License Number ">
                <div class="error" id="error_licensenumber">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="License photo">License Photo:</label>
                <input type="file" accept="image/*" class="form-control" id="licensephoto" name="licensephoto"
                    placeholder="Enter Your License Photo ">
                <div class="error" id="error_licensephoto">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="Date of Birth">Date of Birth:</label>
                <input type="date" class="form-control" id="dateofbirth" name="dateofbirth"
                    placeholder="Enter Your Date of Birth  ">
                <div class="error" id="error_dateofbirth">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="Date of Birth">Add Description:</label>
                <input type="textarea" class="form-control" id="description" name="description"
                    placeholder="Enter Your Description  ">
                <div class="error" id="error_description">

                </div>
            </div>
        </div>
        <!-- <P>Education Details</p> -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="education">Enter College/School Name:</label>
                <input type="text" class="form-control" id="education" name="education"
                    placeholder="Enter Your College/School Name ">
                <div class="error" id="error_education">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="degree">Degree:</label>
                <input type="text" class="form-control" id="degree" name="degree"
                    placeholder="Enter Your College/School Name ">
                <div class="error" id="error_degree">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="startdate">Start Date:</label>
                <input type="date" class="form-control" id="startdate" name="startdate"
                    placeholder="Enter Your Start Date ">
                <div class="error" id="error_startdate">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="enddate">End Date:</label>
                <input type="date" class="form-control" id="enddate" name="enddate" placeholder="Enter Your End Date ">
                <div class="error" id="error_enddate">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="experience">Work Experience:</label>
                <input type="text" class="form-control" id="experience" name="experience"
                    placeholder="Enter Your Work Experience ">
                <div class="error" id="error_experience">
                </div>
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

<script>
//     $("#createprovider").submit(function (e){
//      e.preventDefault();
//      var data = new FormData(this);
//      console.log(data);
//      $.ajax({
//      type:'post',
//      url:"{{route('provider.add')}}",
//      cache: false,
//      contentType: false,
//      processData: false,
//      dataType: "JSON",
//      data : {data: data},
//      headers: {
//      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//      },
    
//     success:function(data){
//     console.log(data);
//     location.reload();
//     $("body").removeClass("modal-open");
//      },
//     error:function(data){                                     
//     $.each(data.responseJSON.errors, function(id,msg){
//     $('#error_'+id).html(msg);
//  })
// }
// });

// });

// (function(){
//     $("#createprovider").submit(function (e){
//      e.preventDefault();
//      alert();
//      var data = new FormData(this);
//      console.log(data);
//      $.ajax({
//      type:'post',
//      url:"{{route('provider.add')}}",
//      cache: false,
//      contentType: false,
//      processData: false,
//      dataType: "JSON",
//      data : {data: data},
//      headers: {
//      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//      },
    
//     success:function(data){
//     console.log(data);
//     location.reload();
//     $("body").removeClass("modal-open");
//      },
//     error:function(data){                                     
//     $.each(data.responseJSON.errors, function(id,msg){
//     $('#error_'+id).html(msg);
//  })
// }
// });

// });
// })
</script>