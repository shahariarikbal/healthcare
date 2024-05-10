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
        <section class="vh-100 login-bg-color">
            <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                <div class="login-radius">
                    <div class="row g-0">
                        <div class="col-md-5 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">
                                <form method="POST" action="{{ route('login') }}">
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
                                
                                <div class="others-login-panel">
                                    <a href="{{ route('receptionist.login') }}" class="btn btn-sm btn-info">FrontDesk login</a>
                                    <a href="{{ route('account.login') }}" class="btn btn-sm btn-primary">Account login</a>
                                    <a href="{{ route('doctor.login') }}" class="btn btn-sm btn-danger">Doctor login</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 d-none d-md-block">
                            {{-- <img src="{{ asset('assets/images/admin.avif') }}"
                            alt="login form" class="img-fluid" /> --}}
                            
                            
                        </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </section>
    </body>
</html>
