@extends('receptionist.master')

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
                                   <form class="row g-3" action="{{ route('receptionist.profile.settings.update') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                             <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                             <input type="text" class="form-control" name="first_name" value="{{ $authUser->first_name ?? old('first_name') }}" placeholder="eg: Reception"/>
                                             <span class="text-danger">{{ $errors->has('first_name') ? $errors->first('first_name') : ' ' }}</span>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                             <label for="last_name" class="form-label">Last Name </label>
                                             <input type="text" class="form-control" name="last_name" value="{{ $authUser->last_name ?? old('last_name') }}" placeholder="eg: officer"/>
                                             <span class="text-danger">{{ $errors->has('last_name') ? $errors->first('last_name') : ' ' }}</span>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                             <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                             <input type="email" class="form-control" name="email" value="{{ $authUser->email ?? old('email') }}" placeholder="eg: admin@admin.com"/>
                                             <span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : ' ' }}</span>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                             <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                                             <input type="text" class="form-control" name="phone" value="{{ $authUser->phone ?? old('phone') }}" placeholder="eg: 01XXXXXXXXXXX"/>
                                             <span class="text-danger">{{ $errors->has('phone') ? $errors->first('phone') : ' ' }}</span>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <label for="qualification" class="form-label">Qualifications <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="qualification" value="{{ $authUser->qualification ?? old('qualification') }}" placeholder="e.g: Qualifications"/>
                                            <span class="text-danger">{{ $errors->has('qualification') ? $errors->first('qualification') : ' ' }}</span>
                                       </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                             <label for="phone" class="form-label">Avatar </label>
                                             <input type="file" class="form-control" name="avatar" onchange="imageChange(event)"/>
                                             @if(isset($authUser->avatar))
                                             <img src="{{ asset($authUser->avatar) }}" id="imagePreview" class="avatar-size"/>
                                             @else
                                             <img src="{{ asset(App\Constants\Statics::DEFAULT_IMAGE_SET) }}" class="avatar-size"  />
                                             @endif
                                             <span class="text-danger">{{ $errors->has('avatar') ? $errors->first('avatar') : ' ' }}</span>
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
                                   <form class="row g-3" action="{{ route('receptionist.profile.password.update') }}" method="POST">
                                        @csrf
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                             <label for="old_password" class="form-label">Old password <span class="text-danger">*</span></label>
                                             <input type="password" class="form-control" name="old_password" value="{{ old('old_password') }}" placeholder="eg: ****"/>
                                             <span class="text-danger">{{ $errors->has('old_password') ? $errors->first('old_password') : ' ' }}</span>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                             <label for="password" class="form-label">New password <span class="text-danger">*</span></label>
                                             <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="eg: ****"/>
                                             <span class="text-danger">{{ $errors->has('password') ? $errors->first('password') : ' ' }}</span>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                             <label for="password_confirmation" class="form-label">Confirm password <span class="text-danger">*</span></label>
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