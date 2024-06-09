@extends('admin.master')

@section('content')
<div class="row py-2">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xl-3 col-xs-12">
        <div class="card dashboard-card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate mb-2">Total Appointment</p>
                        <h4 class="mb-2">{{ $totalAppointments ?? 0 }}</h4>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title rounded-3">
                            <i class="fa-regular fa-calendar-check icon"></i>
                        </span>
                    </div>
                </div>                                            
            </div><!-- end cardbody -->
        </div><!-- end card -->
    </div><!-- end col -->
    <div class="col-lg-3 col-md-3 col-sm-6 col-xl-3 col-xs-12">
        <div class="card dashboard-card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate mb-2">Today Appointment</p>
                        <h4 class="mb-2">{{ $todayAppointments ?? 0 }}</h4>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title rounded-3">
                            <i class="fa-regular fa-calendar-check icon"></i>
                        </span>
                    </div>
                </div>                                              
            </div><!-- end cardbody -->
        </div><!-- end card -->
    </div><!-- end col -->
    <div class="col-lg-3 col-md-3 col-sm-6 col-xl-3 col-xs-12">
        <div class="card dashboard-card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate mb-2">Patients</p>
                        <h4 class="mb-2">{{ $patients ?? 0 }}</h4>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title rounded-3">
                        <i class="fa-solid fa-bed-pulse icon"></i>
                        </span>
                    </div>
                </div>                                              
            </div><!-- end cardbody -->
        </div><!-- end card -->
    </div><!-- end col -->
    <div class="col-lg-3 col-md-3 col-sm-6 col-xl-3 col-xs-12">
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
    </div><!-- end col -->
    <div class="col-lg-8 col-md-8 col-sm-12 mt-4">Chart</div>
    <div class="col-lg-4 col-md-4 col-sm-12 mt-4">Card</div>
</div>
@endsection