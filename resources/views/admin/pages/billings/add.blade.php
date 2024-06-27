@extends('admin.master')

@section('content')
    <div class="container mt-3">
          <div class="col-lg-12 col-md-12 mb-25">
               <div class="card">
                    <div class="card-header">
                         Patient [ {{ $appointment->patient?->name }} ] Bill Collect
                          <a href="{{ route('accounts.billing.manage') }}" class="btn btn-sm float-end btn-manage">Manage</a>
                    </div>
                    <div class="card-body">
                         <form class="row g-3" action="{{ route('accounts.bill.store', $appointment->id) }}" method="POST">
                              @csrf
                              <div class="col-6">
                                   <label for="doctor_id" class="form-label">Doctors <span class="text-danger">*</span></label>
                                   <select class="form-control" name="doctor_id" id="doctor_id" disabled>
                                        <option selected disabled>Seelct a doctor</option>
                                        @foreach ($doctors as $doctor)
                                           <option value="{{ $doctor->id }}" {{ $appointment->doctor_id === $doctor->id ? 'selected' : '' }}>{{ Str::ucfirst($doctor->full_name ?? '') }}</option>
                                        @endforeach
                                   </select>
                                   <input type="hidden" name="doctor_id" value="{{ $appointment->doctor_id }}">
                                   <span class="text-danger">{{ $errors->has('doctor_id') ? $errors->first('doctor_id') : ' ' }}</span>
                              </div>

                              <div class="col-6">
                                   <label for="fee" class="form-label">Payable amount <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control" readonly name="fee" value="{{ $appointment->doctor?->fee }}" placeholder="eg: $800"/>
                                   <span class="text-danger">{{ $errors->has('fee') ? $errors->first('fee') : ' ' }}</span>
                              </div>

                              <div class="col-6">
                                   <label for="patient_id" class="form-label">Patient <span class="text-danger">*</span></label>
                                   <select class="form-control" name="patient_id" id="patient_id" disabled>
                                        <option selected disabled>Seelct a patient</option>
                                        @foreach ($patients as $patient)
                                           <option value="{{ $patient->id }}" {{ $appointment->patient_id === $patient->id ? 'selected' : '' }}>{{ Str::ucfirst($patient->name ?? '') }}</option>
                                        @endforeach
                                   </select>
                                   <input type="hidden" name="patient_id" value="{{ $appointment->patient_id }}">
                                   <span class="text-danger">{{ $errors->has('patient_id') ? $errors->first('patient_id') : ' ' }}</span>
                              </div>

                              <div class="col-6">
                                   <label for="appointment_date" class="form-label">Appointment date <span class="text-danger">*</span></label>
                                   <input type="date" min="Y-m-d" readonly class="form-control" name="appointment_date" value="{{ $appointment->appointment_date ?? old('appointment_date') }}" placeholder="eg: dd/mm/yyyy"/>
                                   <span class="text-danger">{{ $errors->has('appointment_date') ? $errors->first('appointment_date') : ' ' }}</span>
                              </div>

                              <div class="col-6">
                                   <label for="payment_type" class="form-label">Payment type <span class="text-danger">*</span></label>
                                   <select class="form-control" name="payment_type" id="payment_type">
                                        <option selected disabled>Select A Type</option>
                                        <option value="cash">Cash</option>
                                        <option value="card">Card</option>
                                   </select>
                                   <span class="text-danger">{{ $errors->has('payment_type') ? $errors->first('payment_type') : ' ' }}</span>
                              </div>

                              <div class="col-6">
                                   <label for="payment_date" class="form-label">Payment date <span class="text-danger">*</span></label>
                                   <input type="date" min="Y-m-d" class="form-control" name="payment_date" value="{{ $appointment->payment_date ?? old('payment_date') }}" placeholder="eg: dd/mm/yyyy"/>
                                   <span class="text-danger">{{ $errors->has('payment_date') ? $errors->first('payment_date') : ' ' }}</span>
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