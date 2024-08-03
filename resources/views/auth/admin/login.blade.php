<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Admin Login</title>
        <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/login-style.css') }}" />
    </head>
    <body>
        <section class="login-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="login-form-outer">
                            <form method="POST" action="{{ route('login') }}" class="login-form">
                                @csrf
                                <div class="d-flex align-items-center mb-3 pb-1">
                                    <img src="{{ asset('assets/images/login-logo.png') }}" class="login-logo" />
                                    <span class="mb-0 login-text">Admin Login</span>
                                </div>            
                                <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>
            
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="email">Email address</label>
                                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Enter your email" />
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
            
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password" />
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <button class="btn login-btn" type="submit">Login</button>
                            </form> 
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="others-login-panel panel-login-url-box">
                            <a href="{{ route('receptionist.login') }}" class="btn btn-sm btn-info">Receiptionist</a>
                            <a href="{{ route('account.login') }}" class="btn btn-sm btn-primary">Account</a>
                            <a href="{{ route('doctor.login') }}" class="btn btn-sm btn-danger">Doctor</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
