<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Base Admin Login</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <!-- Style css -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <!-- custome style -->
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
    <section class="form__section base__bg">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="base__form__wrapper">
                        <div class="base__heading text-center mb-3">
                            <div class="base__logo__img">
                               <img src="{{URL::to('/')}}/images/delooni-logo.svg" alt="Logo" height="600px" width="500px">
                             </div>                           
                        </div>
                        <div class="base__form">
                            <h4 class="mb-3 text-center">Admin</h4>
                            <form action="login" method="post">
                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger  alert-dismissible" role="alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
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
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" name="password" placeholder="Password" aria-label="Password" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2"><i class="fas fa-lock"></i></span>
                                    </div>
                                </div>

                                @if ($errors->has('password'))
                                <div class="alert alert-error">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </div>
                                @endif
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="check__box">
                                            <input name="remember" type="checkbox" id="remember">
                                            <label for="remember">
                                                Remember Me
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-primary btn-block app-button">Login</button>
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