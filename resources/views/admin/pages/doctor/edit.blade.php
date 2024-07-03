@extends('admin.master')

@section('content')
    <div class="container mt-3">
          <div class="col-md-12">
               <div class="card">
                    <div class="card-header">
                          Dr. {{ $doctor->full_name }} Profile Edit
                          <a href="{{ route('doctor.manage') }}" class="btn btn-sm float-end btn-manage">Manage</a>
                    </div>
                    <div class="card-body">
                         <form class="row g-3" action="{{ route('doctor.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <div class="col-12">
                                   <label for="department" class="form-label">Department <span class="text-danger">*</span></label>
                                   <select class="form-control" name="department_id" id="department_id">
                                        <option selected disabled>Seelct a department</option>
                                        @foreach ($departments as $department)
                                           <option value="{{ $department->id }}" {{ $doctor->department_id === $department->id ? 'selected' : '' }}>{{ Str::ucfirst($department->name ?? '') }}</option>
                                        @endforeach
                                   </select>
                                   <span class="text-danger">{{ $errors->has('department_id') ? $errors->first('department_id') : ' ' }}</span>
                              </div>
                              <div class="col-md-4">
                                   <label for="firstName" class="form-label">First name <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control" name="first_name" value="{{ $doctor->first_name ?? old('first_name') }}" placeholder="Enter first name..."/>
                                   <span class="text-danger">{{ $errors->has('first_name') ? $errors->first('first_name') : ' ' }}</span>
                              </div>
                              <div class="col-md-4">
                                   <label for="lastName" class="form-label">Last name </label>
                                   <input type="text" class="form-control" name="last_name" value="{{ $doctor->last_name ?? old('last_name') }}" placeholder="Enter last name..."/>
                              </div>
                              <div class="col-md-4">
                                   <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                   <input type="email" class="form-control" name="email" value="{{ $doctor->email ?? old('email') }}" placeholder="Enter email.."/>
                                   <span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : ' ' }}</span>
                              </div>
                              <div class="col-md-4">
                                   <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                                   <input type="tel" class="form-control" name="phone" value="{{ $doctor->phone ?? old('phone') }}" placeholder="Enter phone.."/>
                                   <span class="text-danger">{{ $errors->has('phone') ? $errors->first('phone') : ' ' }}</span>
                              </div>
                              <div class="col-md-4">
                                   <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                                   <select class="form-control" name="gender" id="gender">
                                        <option selected disabled>Select a gender</option>
                                        <option value="Male" {{ $doctor->gender === 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ $doctor->gender === 'Female' ? 'selected' : '' }}>Female</option>
                                   </select>
                                   <span class="text-danger">{{ $errors->has('gender') ? $errors->first('gender') : ' ' }}</span>
                              </div>
                              <div class="col-md-4">
                                   <label for="fee" class="form-label">Fee <span class="text-danger">*</span></label>
                                   <input type="number" class="form-control" name="fee" value="{{ $doctor->fee ?? old('fee') }}" placeholder="Enter fee.."/>
                                   <span class="text-danger">{{ $errors->has('fee') ? $errors->first('fee') : ' ' }}</span>
                              </div>
                              <div class="col-md-6">
                                   <label for="qualification" class="form-label">Qualification (MBBS,FCPS,FRCS) <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control" name="qualification" value="{{ $doctor->qualification ?? old('qualification') }}" placeholder="Enter qualification Exp:MBBS,FCPS,FRCS.."/>
                                   <span class="text-danger">{{ $errors->has('qualification') ? $errors->first('qualification') : ' ' }}</span>
                              </div>
                              <div class="col-md-6">
                                   <label for="experience" class="form-label">Experience (No of years) <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control" name="experience" value="{{ $doctor->experience ?? old('experience') }}" placeholder="Enter experience..."/>
                                   <span class="text-danger">{{ $errors->has('experience') ? $errors->first('experience') : ' ' }}</span>
                              </div>

                              <div class="col-md-12">
                                   <label for="address" class="form-label">Present Address <span class="text-danger">*</span></label>
                                   <textarea class="form-control" name="address" rows="4" placeholder="Enter present address">{{ $doctor->address ?? old('address') }}</textarea>
                                   <span class="text-danger">{{ $errors->has('address') ? $errors->first('address') : ' ' }}</span>
                              </div>

                              <div class="col-12">
                                   <label for="about" class="form-label">Abouts </label>
                                   <textarea class="form-control" name="about" rows="8" placeholder="Enter doctor abouts">{{ $doctor->about ?? old('about') }}</textarea>
                                   <span class="text-danger">{{ $errors->has('about') ? $errors->first('about') : ' ' }}</span>
                              </div>

                              <div class="col-md-6">
                                   <label for="avatar" class="form-label">Avatar <span class="text-danger">*</span></label>
                                   <input type="file" class="form-control" name="avatar" onchange="imageChange(event)" />
                                   @if(!empty($doctor->avatar))
                                   <img src="{{ asset($doctor->avatar) }}" id="imagePreview" class="avatar-size" />
                                   @else
                                   <img src="{{ asset(App\Constants\Statics::DEFAULT_IMAGE_SET) }}" class="avatar-size" />
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
    </div>
@endsection