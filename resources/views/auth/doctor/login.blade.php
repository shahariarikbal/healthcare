<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Doctor Login</title>
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
                  
                  <div class="col-lg-6 col-md-12 d-flex align-items-center">
                    <div class="card-body p-4 p-lg-5 text-black">
    
                      @if(session('error'))
                          <div class="alert alert-danger">
                              {{ session('error') }}
                          </div>
                      @endif

                      <form method="POST" action="{{ route('doctor.login') }}">
                        @csrf
                        <div class="d-flex align-items-center mb-3 pb-1">
                          <img src="{{ asset('assets/images/login-logo.png') }}" class="login-logo" />
                          <span class="mb-0 login-text">Doctor Login</span>
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
                  <div class="col-md-6 d-none d-md-block"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
</body>
</html>