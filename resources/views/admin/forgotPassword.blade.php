<section class="form__section hspl__bg h-100">
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
                            <h4 class="primary-color mb-3 text-center">Forgot Password</h4>
                            <form action="forgotpwd" method="post" autocomplete="off">
                               @csrf
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" name="email" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                                    </div>
                                 
                                </div>
                                @if ($errors->has('email'))
                                <div class="alert alert-error">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                                @endif
                                <div class="row align-items-center">
                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-primary btn-block">Send Email</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
