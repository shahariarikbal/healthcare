@extends('admin.master')

@section('content')
    <div class="container mt-3">
          <div class="col-lg-12 col-md-12">
               <div class="card">
                    <div class="card-header">
                          Patient Add
                          <a href="{{ route('patient.manage') }}" class="btn btn-sm float-end btn-manage">Manage</a>
                    </div>
                    <div class="card-body">
                         <form class="row g-3" action="{{ route('patient.update', $patient->id) }}" method="POST">
                              @csrf
                              <div class="col-lg-4 col-md-12">
                                   <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control" name="name" value="{{ $patient->name ?? old('name') }}" placeholder="Enter patient name..."/>
                                   <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : ' ' }}</span>
                              </div>
                              <div class="col-lg-4 col-md-12">
                                   <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                   <input type="email" class="form-control" name="email" value="{{ $patient->email ?? old('email') }}" placeholder="Enter email.."/>
                                   <span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : ' ' }}</span>
                              </div>
                              <div class="col-lg-4 col-md-12">
                                   <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                                   <input type="tel" class="form-control" name="phone" value="{{ $patient->phone ?? old('phone') }}" placeholder="Enter phone.."/>
                                   <span class="text-danger">{{ $errors->has('phone') ? $errors->first('phone') : ' ' }}</span>
                              </div>
                              <div class="col-lg-12 col-md-12">
                                   <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                                   <textarea class="form-control" name="address" rows="5" placeholder="Enter patient address">{{ $patient->address ?? old('address') }}</textarea>
                                   <span class="text-danger">{{ $errors->has('address') ? $errors->first('address') : ' ' }}</span>
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