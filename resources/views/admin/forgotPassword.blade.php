<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Style css -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
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

</body>

</html>