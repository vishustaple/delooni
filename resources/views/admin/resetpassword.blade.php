  <section class="form__section hspl__bg">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-5">
                   <!--for success message-->
                     @if ($message = Session::get('success'))
                        <div class="alert alert-success  alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>{{ $message }}</strong>
                        </div>
                     @endif  
                    <div class="hpl__form__wrapper">
                        <div class="hpl__heading text-center mb-3">
                            <div class="thoro__logo__img">
                                <img src="{{asset('images/thorough-logo.svg')}}" alt="Logo" />
                            </div>
                            <h3 class="font-weight-bold">Delooni</h3>
                        </div>
                        <div class="hpl__form">
                            <h4 class="primary-color mb-3 text-center">Reset Password</h4>
                            <form action = "{{ route('updatepwd') }}"   method="post">
                            <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="token" id="token" value="{{ $token }}" />
                            <div class="input-group mb-3">
                                    <input type="password" class="form-control" name="password" placeholder="Enter your new password" aria-label="Password" aria-describedby="basic-addon1">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                                    </div>
                               </div>
                                @if ($errors->has('password'))
                                <div class="alert alert-error">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </div>
                                @endif
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" name="confirm_password" placeholder="Enter your new confirm password" aria-label="confirm_password" aria-describedby="basic-addon1">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                                    </div>
                                </div>
                                @if ($errors->has('confirm_password'))
                                <div class="alert alert-error">
                                    <strong>{{ $errors->first('confirm_password') }}</strong>
                                </div>
                                @endif
                               <div class="row align-items-center">
                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
