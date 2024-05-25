@extends('admin.master')

@section('content')
    <div class="container mt-3">
          <div class="col-lg-12 col-md-12 mb-25">
               <div class="card">
                    <div class="card-header">
                         Receptionist Edit
                          <a href="{{ route('reception.manage') }}" class="btn btn-sm float-end btn-manage">Manage</a>
                    </div>
                    <div class="card-body">
                         <form class="row g-3" action="{{ route('reception.update', $receptionist->id) }}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <div class="col-lg-4 col-md-4 col-sm-12">
                                   <label for="firstName" class="form-label">First name <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control" name="first_name" value="{{ $receptionist->first_name ?? old('first_name') }}" placeholder="eg: Rahima"/>
                                   <span class="text-danger">{{ $errors->has('first_name') ? $errors->first('first_name') : ' ' }}</span>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-12">
                                   <label for="lastName" class="form-label">Last name </label>
                                   <input type="text" class="form-control" name="last_name" value="{{ $receptionist->last_name ?? old('last_name') }}" placeholder="eg: aktar"/>
                              </div>

                              <div class="col-lg-4 col-md-4 col-sm-12">
                                   <label for="blood_group" class="form-label">Blood group <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control" name="blood_group" value="{{ $receptionist->blood_group ?? old('blood_group') }}" placeholder="eg: o+"/>
                                   <span class="text-danger">{{ $errors->has('blood_group') ? $errors->first('blood_group') : ' ' }}</span>
                              </div>

                              <div class="col-lg-6 col-md-6 col-sm-12">
                                   <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                   <input type="email" class="form-control" name="email" value="{{ $receptionist->email ?? old('email') }}" placeholder="eg: receptionist@info.com"/>
                                   <span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : ' ' }}</span>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-12">
                                   <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                                   <input type="tel" class="form-control" name="phone" value="{{ $receptionist->phone ?? old('phone') }}" placeholder="eg: 01309608232"/>
                                   <span class="text-danger">{{ $errors->has('phone') ? $errors->first('phone') : ' ' }}</span>
                              </div>
                              <div class="col-md-4">
                                   <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                                   <select class="form-control" name="gender" id="gender">
                                        <option selected disabled>Select a gender</option>
                                        <option value="Man" {{ $receptionist->gender === 'Man' ? 'selected' : '' }}>Man</option>
                                        <option value="Woman" {{ $receptionist->gender === 'Woman' ? 'selected' : '' }}>Woman</option>
                                   </select>
                                   <span class="text-danger">{{ $errors->has('gender') ? $errors->first('gender') : ' ' }}</span>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-12">
                                   <label for="dob" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                   <input type="date" class="form-control" name="dob" value="{{ $receptionist->dob ?? old('dob') }}" placeholder="eg: dd/mm/YYYY"/>
                                   <span class="text-danger">{{ $errors->has('dob') ? $errors->first('dob') : ' ' }}</span>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-12">
                                   <label for="join_date" class="form-label">Join date <span class="text-danger">*</span></label>
                                   <input type="date" class="form-control" name="join_date" value="{{ $receptionist->join_date ?? old('join_date') }}" placeholder="eg: dd/mm/YYYY"/>
                                   <span class="text-danger">{{ $errors->has('join_date') ? $errors->first('join_date') : ' ' }}</span>
                              </div>

                              <div class="col-md-6">
                                   <label for="qualification" class="form-label">Educational Qualification <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control" name="qualification" value="{{ $receptionist->qualification ?? old('qualification') }}" placeholder="Enter qualification"/>
                                   <span class="text-danger">{{ $errors->has('qualification') ? $errors->first('qualification') : ' ' }}</span>
                              </div>
                              <div class="col-md-6">
                                   <label for="experience" class="form-label">Experience (No of years) <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control" name="experience" value="{{ $receptionist->experience ?? old('experience') }}" placeholder="Enter work experience..."/>
                                   <span class="text-danger">{{ $errors->has('experience') ? $errors->first('experience') : ' ' }}</span>
                              </div>

                              <div class="col-md-12">
                                   <label for="address" class="form-label">Present Address <span class="text-danger">*</span></label>
                                   <textarea class="form-control" name="address" rows="4" placeholder="Enter present address">{{ $receptionist->address ?? old('address') }}</textarea>
                                   <span class="text-danger">{{ $errors->has('address') ? $errors->first('address') : ' ' }}</span>
                              </div>

                              <div class="col-md-6">
                                   <label for="avatar" class="form-label">Avatar <span class="text-danger">*</span></label>
                                   <input type="file" class="form-control" name="avatar" onchange="imageChange(event)"/>
                                   @if($receptionist->avatar)
                                   <img src="{{ asset($receptionist->avatar) }}" class="avatar-size" />
                                   @else
                                   <img src="{{ asset(App\Constants\Status::DEFAULT_IMAGE_SET) }}" id="imagePreview" class="avatar-size" />
                                   @endif
                                   
                              </div>

                              <span class="text-danger">{{ $errors->has('avatar') ? $errors->first('avatar') : ' ' }}</span>

                              <div class="col-12">
                                   <button type="submit" class="btn btn-submit">Submit</button>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
    </div>
@endsection