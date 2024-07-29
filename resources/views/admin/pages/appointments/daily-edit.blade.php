@extends('admin.master')

@section('content')
    <div class="container mt-3">
          <div class="col-lg-12 col-md-12 mb-25">
               <div class="card">
                    <div class="card-header hc-header-outer">
                         <h4 class="hc-header-title">
                              Appointment Edit
                         </h4>
                         <a href="{{ route('appointment.daily') }}" class="btn btn-sm btn-manage">Manage</a>
                    </div>
                    <div class="card-body">
                         <form class="row g-3" action="{{ route('appointment.daily.update', $appointment->id) }}" method="POST">
                              @csrf
                              <div class="col-12">
                                   <label for="doctor_id" class="form-label">Doctors <span class="text-danger">*</span></label>
                                   <select class="form-control" name="doctor_id" id="doctor_id">
                                        <option selected disabled>Seelct a doctor</option>
                                        @foreach ($doctors as $doctor)
                                           <option value="{{ $doctor->id }}" {{ $appointment->doctor_id === $doctor->id ? 'selected' : '' }}>{{ Str::ucfirst($doctor->full_name ?? '') }}</option>
                                        @endforeach
                                   </select>
                                   <span class="text-danger">{{ $errors->has('doctor_id') ? $errors->first('doctor_id') : ' ' }}</span>
                              </div>

                              <div class="col-12">
                                   <label for="patient_id" class="form-label">Patient <span class="text-danger">*</span></label>
                                   <select class="form-control" name="patient_id" id="patient_id">
                                        <option selected disabled>Seelct a patient</option>
                                        @foreach ($patients as $patient)
                                           <option value="{{ $patient->id }}" {{ $appointment->patient_id === $patient->id ? 'selected' : '' }}>{{ Str::ucfirst($patient->name ?? '') }}</option>
                                        @endforeach
                                   </select>
                                   <span class="text-danger">{{ $errors->has('patient_id') ? $errors->first('patient_id') : ' ' }}</span>
                              </div>

                              <div class="col-lg-12 col-md-12 col-sm-12">
                                   <label for="appointment_date" class="form-label">Appointment date <span class="text-danger">*</span></label>
                                   <input type="date" min="Y-m-d" class="form-control" name="appointment_date" value="{{ $appointment->appointment_date ?? old('appointment_date') }}" placeholder="eg: dd/mm/yyyy"/>
                                   <span class="text-danger">{{ $errors->has('appointment_date') ? $errors->first('appointment_date') : ' ' }}</span>
                              </div>

                              <div class="col-md-12">
                                   <label for="problem" class="form-label">Diseased <span class="text-danger">*</span></label>
                                   <textarea class="form-control" name="problem" rows="4" placeholder="Enter Patient Diseased">{{ $appointment->problem ?? old('problem') }}</textarea>
                                   <span class="text-danger">{{ $errors->has('problem') ? $errors->first('problem') : ' ' }}</span>
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