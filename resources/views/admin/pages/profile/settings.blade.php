@extends('admin.master')

@section('content')
    <div class="container-fluid mt-3">
          <div class="col-lg-12 col-md-12 mb-25">
               <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                         <div class="card">
                              <div class="card-header">
                                   Profile settings
                              </div>
                              <div class="card-body">
                                   <form class="row g-3" action="{{ route('admin.profile.settings.update') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                             <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                             <input type="text" class="form-control" name="name" value="{{ $authUser->name ?? old('name') }}" placeholder="eg: Admin"/>
                                             <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : ' ' }}</span>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                             <label for="email" class="form-label">Email </label>
                                             <input type="text" class="form-control" name="email" value="{{ $authUser->email ?? old('email') }}" placeholder="eg: admin@admin.com"/>
                                             <span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : ' ' }}</span>
                                        </div>
                                        <div class="col-12">
                                             <button type="submit" class="btn btn-submit">Submit</button>
                                        </div>
                                   </form>
                              </div>
                         </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                         <div class="card">
                              <div class="card-header">
                                   Password settings
                              </div>
                              <div class="card-body">
                                   <form class="row g-3" action="{{ route('admin.password.update') }}" method="POST">
                                        @csrf
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                             <label for="old_password" class="form-label">Old password <span class="text-danger">*</span></label>
                                             <input type="password" class="form-control" name="old_password" value="{{ old('old_password') }}" placeholder="eg: ****"/>
                                             <span class="text-danger">{{ $errors->has('old_password') ? $errors->first('old_password') : ' ' }}</span>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                             <label for="password" class="form-label">New password </label>
                                             <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="eg: ****"/>
                                             <span class="text-danger">{{ $errors->has('password') ? $errors->first('password') : ' ' }}</span>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                             <label for="password_confirmation" class="form-label">Confirm password </label>
                                             <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="eg: ****"/>
                                        </div>
                                        <div class="col-12">
                                             <button type="submit" class="btn btn-submit">Submit</button>
                                        </div>
                                   </form>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
    </div>
</div>
@endsection