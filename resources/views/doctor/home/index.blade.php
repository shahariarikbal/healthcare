@extends('doctor.master')

@section('content')
<div class="row py-2">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 total-card">
        <a href="{{ route('appointment.own.all') }}">
            <div class="card dashboard-card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate mb-2">Total Appointment</p>
                            <h4 class="mb-2">{{ $appointment['totalAppointment'] ?? 0 }}</h4>
                        </div>
                        <div class="avatar-sm">
                            <span class="avatar-title rounded-3">
                                <i class="fa-regular fa-calendar-check icon"></i>
                            </span>
                        </div>
                    </div>                                            
                </div><!-- end cardbody -->
            </div><!-- end card -->
        </a>
    </div><!-- end col -->
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 total-card">
        <a href="{{ route('appointment.own.daily') }}">
            <div class="card dashboard-card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate mb-2">Today Appointment</p>
                            <h4 class="mb-2">{{ $appointment['todayTotalAppointment'] ?? 0 }}</h4>
                        </div>
                        <div class="avatar-sm">
                            <span class="avatar-title rounded-3">
                                <i class="fa-regular fa-calendar-check icon"></i>
                            </span>
                        </div>
                    </div>                                              
                </div><!-- end cardbody -->
            </div><!-- end card -->
        </a>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <a href="{{ route('appointment.own.schedule') }}">
            <div class="card dashboard-chart">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate mb-2">Schedule Appointment</p>
                            <h4 class="mb-2">{{ $appointment['scheduleTotalAppointment'] ?? 0 }}</h4>
                        </div>
                        <div class="avatar-sm">
                            <span class="avatar-title rounded-3">
                                <i class="fa-regular fa-calendar-check icon"></i>
                            </span>
                        </div>
                    </div>   
                </div>
            </div>
        </a>
 </div>
    <!-- end col -->
    
    <div class="col-lg-12 col-md-12 col-sm-12 mt-4 chart-card">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-6 col-xl-4 col-xs-12 total-card">
               <a href="{{ route('prescription.auth.doctor.list') }}">
                   <div class="card dashboard-card">
                       <div class="card-body">
                           <div class="d-flex">
                               <div class="flex-grow-1">
                                   <p class="text-truncate mb-2">Total Prescription</p>
                                   <h4 class="mb-2">{{ $data['totalPrescription'] ?? 0 }}</h4>
                               </div>
                               <div class="avatar-sm">
                                   <span class="avatar-title rounded-3">
                                   <i class="fa-solid fa-prescription icon"></i>
                                   </span>
                               </div>
                           </div>                                              
                       </div><!-- end cardbody -->
                   </div><!-- end card -->
               </a>
           </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xl-4 col-xs-12 total-card">
               <a href="{{ route('prescription.today') }}">
                   <div class="card dashboard-card">
                       <div class="card-body">
                           <div class="d-flex">
                               <div class="flex-grow-1">
                                   <p class="text-truncate mb-2">Today Prescription</p>
                                   <h4 class="mb-2">{{ $data['todayTotalPrescription'] ?? 0 }}</h4>
                               </div>
                               <div class="avatar-sm">
                                   <span class="avatar-title rounded-3">
                                   <i class="fa-solid fa-prescription icon"></i>
                                   </span>
                               </div>
                           </div>                                              
                       </div><!-- end cardbody -->
                   </div><!-- end card -->
               </a>
           </div><!-- end col -->
           <div class="col-lg-4 col-md-4 col-sm-6 col-xl-4 col-xs-12 total-card">
               <a href="{{ route('doctor.manage') }}">
                   <div class="card dashboard-card">
                       <div class="card-body">
                           <div class="d-flex">
                               <div class="flex-grow-1">
                                   <p class="text-truncate mb-2">Doctors</p>
                                   <h4 class="mb-2">{{ $doctors ?? 0 }}</h4>
                               </div>
                               <div class="avatar-sm">
                                   <span class="avatar-title rounded-3">
                                       <i class="fa-solid fa-user-doctor icon"></i>
                                   </span>
                               </div>
                           </div>                                              
                       </div><!-- end cardbody -->
                   </div><!-- end card -->
               </a>
           </div><!-- end col -->
        </div>
    </div>
</div>
@endsection