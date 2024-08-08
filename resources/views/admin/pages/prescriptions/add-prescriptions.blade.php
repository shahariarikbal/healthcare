@extends('admin.master')

@section('content')
    <div class="container mt-3">
          <div class="col-md-12">
               <div class="card">
                    <div class="card-header hc-header-outer">
                        <h4 class="hc-header-title">
                            Add Prescription
                        </h4>                        
                    </div>
                    <form action="{{ route('prescription.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <p>
                                            <i class="fa fa-user"></i> Name : {{ $doctor->full_name ?? 'NA' }}
                                        </p>
                                        <p>
                                            <i class="fa-solid fa-envelope"></i> E-mail : {{ $doctor->email ?? 'NA' }}
                                        </p>
                                        <p>
                                            <i class="fa-solid fa-graduation-cap"></i> Qualifications : 
                                            @foreach ($qualifications as $k => $qualification)
                                                <span class="badge-active">{{ $qualification ?? 'NA' }}</span>
                                            @endforeach
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
                                        <label for="patient_id" class="form-label">Patient name <span class="text-danger">*</span></label>
                                       <select class="form-control" name="patient_id" id="patient_id">
                                            <option selected disabled>Select a patient</option>
                                            @foreach ($appointments as $appointment)
                                               <option value="{{ $appointment->patient_id }}">{{ Str::ucfirst($appointment->patient?->name ?? '') }}</option>
                                            @endforeach
                                       </select>
                                       <span class="text-danger">{{ $errors->has('patient_id') ? $errors->first('patient_id') : ' ' }}</span>
                                       <input type="hidden" value="{{ $appointment->appointment_date }}" name="appointment_date" />
                                   </div>
                                   <div class="col-md-4">
                                    <label for="name" class="form-label">Gender <span class="text-danger">*</span></label>
                                    <select class="form-control" name="gender" id="gender">
                                        <option selected disabled>Select A Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <span class="text-danger">{{ $errors->has('gender') ? $errors->first('gender') : ' ' }}</span>
                                </div>
                                   <div class="col-md-4">
                                        <label for="age" class="form-label">Age <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="age" value="{{ old('age') }}" placeholder="Enter patient..."/>
                                        <span class="text-danger">{{ $errors->has('age') ? $errors->first('age') : ' ' }}</span>
                                   </div>
                                </div>
                            </div>
    
                            <div class="row mt-3">
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <label for="symptoms">Symptoms/Instructions</label>
                                    <textarea class="form-control" rows="3" name="instructions" placeholder="Enter here..."></textarea>
                                    <span class="text-danger">{{ $errors->has('instructions') ? $errors->first('instructions') : ' ' }}</span>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-9">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label for="medicine">Medicine Name</label>
                                            <input type="text" class="form-control" name="medicine_name[]" id="medicine_name" placeholder="Medicine Name" />
                                            <span class="text-danger">{{ $errors->has('medicine_name.0') ? $errors->first('medicine_name.0') : ' ' }}</span>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-4">
                                            <label for="dose">Dose</label>
                                            <input type="text" class="form-control" name="dose[]" id="dose" placeholder="dose: 1+0+1" />
                                            <span class="text-danger">{{ $errors->has('dose.0') ? $errors->first('dose.0') : ' ' }}</span>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-4">
                                            <label for="duration">Duration</label>
                                            <input type="number" class="form-control" name="duration[]" id="duration" placeholder="eg:21 days" />
                                            <span class="text-danger">{{ $errors->has('duration.0') ? $errors->first('duration.0') : ' ' }}</span>
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-4">
                                            <span class="input-group-text prescription-add-btn" id="addPrescription" onclick="addNewField()" title="Add more">
                                                <i class="fa fa-plus"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div id="addNewInputField"></div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-submit mt-2">Submit</button>
                        </div>
                    </form>
               </div>
          </div>
    </div>
@endsection

@push('script')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        let container = document.getElementById('addNewInputField');
            container.addEventListener('click', function(event) {
           
                if (event.target && event.target.matches('.prescription-remove-btn')) {
                     
                     let inputGroup = event.target.closest('.row');
                     
                     inputGroup.remove();
                }
           });
      });

      function addNewField() {
      let container = document.getElementById('addNewInputField');
      let newFieldId = 'inputField_' + Date.now();
      let newFields = document.createElement('div');
      newFields.innerHTML = `
           <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <label for="medicine">Medicine Name</label>
                    <input type="text" class="form-control" name="medicine_name[]" id="${newFieldId}" placeholder="Medicine Name" required />
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4">
                    <label for="dose">Dose</label>
                    <input type="text" class="form-control" name="dose[]" id="${newFieldId}" placeholder="dose: 1+0+1" required />
                </div>
                <div class="col-lg-2 col-md-2 col-sm-4">
                    <label for="duration">Duration</label>
                    <input type="number" class="form-control" name="duration[]" id="${newFieldId}" placeholder="eg:21" required />
                </div>
                <div class="col-lg-1 col-md-1 col-sm-4">
                    <span class="input-group-text prescription-remove-btn" data-target="${newFieldId}" title="Remove">
                        <small>x</small>
                    </span>
                </div>
            
            </div>
      `;
           container.appendChild(newFields);
      }

</script>
@endpush