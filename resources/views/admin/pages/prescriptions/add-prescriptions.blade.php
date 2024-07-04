@extends('admin.master')

@section('content')
    <div class="container mt-3">
          <div class="col-md-12">
               <div class="card">
                    <div class="card-header">
                        Add Prescription
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <p>
                                        <i class="fa fa-user"></i> Name : Mr.Jone deo
                                    </p>
                                    <p>
                                        <i class="fa-solid fa-envelope"></i> E-mail : jone@info.com
                                    </p>
                                    <p>
                                        <i class="fa-solid fa-graduation-cap"></i> Qualifications : 
                                        <span class="badge-active">MBBS</span>
                                        <span class="badge-active">FCPS</span>
                                        <span class="badge-active">Medicine</span>
                                    </p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                                    <p>
                                        <i class="fa fa-home"></i> Address :  H-8, R-3/E, Sector-9, Uttara, Dhaka, Bangladesh
                                    </p>
                                    <p>
                                        <i class="fa fa-phone"></i> Call :  +8801309608232, +8801885131495
                                    </p>
                                    <p>
                                        <i class="fa-solid fa-envelope"></i> E-mail : health@info.com
                                    </p>
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" class="form-label">Patient name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter patient name..."/>
                                    <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : ' ' }}</span>
                               </div>
                               <div class="col-md-4">
                                <label for="name" class="form-label">Gender <span class="text-danger">*</span></label>
                                <select class="form-control" name="gender" id="gender">
                                    <option selected disabled>Select A Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                                <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : ' ' }}</span>
                           </div>
                               <div class="col-md-4">
                                    <label for="age" class="form-label">Age <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="age" value="{{ old('age') }}" placeholder="Enter patient..."/>
                               </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <label for="symptoms">Symptoms</label>
                                <textarea class="form-control" rows="3" placeholder="Add Symptoms here..."></textarea>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <div class="row">
                                    <div class="col-lg-7 col-md-8 col-sm-12">
                                        <label for="symptoms">Medicine Name</label>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-4">
                                        <label for="symptoms">Medicine Name</label>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-4">
                                        <label for="symptoms">Days</label>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-4">
                                        <button class="btn btn-success" type="button">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
               </div>
          </div>
    </div>
@endsection

@push('script')

@endpush