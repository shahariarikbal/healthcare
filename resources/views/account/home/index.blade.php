@extends('account.master')

@section('content')
<div class="row py-2">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xl-3 col-xs-12 total-card">
        <a href="{{ route('appointment.all') }}">
            <div class="card dashboard-card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate mb-2">Total Appointment</p>
                            <h4 class="mb-2">{{ $data['totalAppointments'] ?? 0 }}</h4>
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
    <div class="col-lg-3 col-md-3 col-sm-6 col-xl-3 col-xs-12 total-card">
        <a href="{{ route('appointment.daily') }}">
            <div class="card dashboard-card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate mb-2">Today Appointment</p>
                            <h4 class="mb-2">{{ $data['todayAppointments'] ?? 0 }}</h4>
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
    <div class="col-lg-3 col-md-3 col-sm-6 col-xl-3 col-xs-12 total-card">
        <a href="{{ route('patient.manage') }}">
            <div class="card dashboard-card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate mb-2">Patients</p>
                            <h4 class="mb-2">{{ $data['totalPatients'] ?? 0 }}</h4>
                        </div>
                        <div class="avatar-sm">
                            <span class="avatar-title rounded-3">
                            <i class="fa-solid fa-bed-pulse icon"></i>
                            </span>
                        </div>
                    </div>                                              
                </div><!-- end cardbody -->
            </div><!-- end card -->
        </a>
    </div><!-- end col -->
    <div class="col-lg-3 col-md-3 col-sm-6 col-xl-3 col-xs-12 total-card">
        <a href="{{ route('doctor.manage') }}">
            <div class="card dashboard-card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate mb-2">Doctors</p>
                            <h4 class="mb-2">{{ $data['totalDoctors'] ?? 0 }}</h4>
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
    <div class="col-lg-8 col-md-8 col-sm-12 mt-4 chart-card">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="card dashboard-chart">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate mb-2">Schedule Appointment</p>
                                <span>{{ $data['totalSecheduleAppointment'] ?? '0' }}</span>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title rounded-3">
                                    <i class="fa-regular fa-calendar-check icon"></i>
                                </span>
                            </div>
                        </div>   
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="card dashboard-chart">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate mb-2">Today Bill Collect</p>
                                <span class="text-success">Own report: {{ '$'. $data['todayTotalBillCollect'] ?? '0' }}</span>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title rounded-3">
                                    <i class="fa-solid fa-file-invoice-dollar icon"></i>
                                </span>
                            </div>
                        </div>   
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="card dashboard-chart">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate mb-2">Total Bill Collect</p>
                                <span class="text-success">Own report: {{ '$'. $data['totalBillCollect'] ?? '0' }}</span>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title rounded-3">
                                    <i class="fa-solid fa-file-invoice-dollar icon"></i>
                                </span>
                            </div>
                        </div>   
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mt-2">
                <div class="card dashboard-chart">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate mb-2">Today Expanse</p>
                                <h4 class="mb-2">{{ '$'. $data['todayTotalExpanse'] }}</h4>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title rounded-3">
                                    <i class="fa-solid fa-file-invoice-dollar icon"></i>
                                </span>
                            </div>
                        </div>   
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mt-2">
                <div class="card dashboard-chart">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate mb-2">Monthly Expanse</p>
                                <h4 class="mb-2">{{ '$'. $data['monthlyTotalExpanse'] }}</h4>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title rounded-3">
                                    <i class="fa-solid fa-file-invoice-dollar icon"></i>
                                </span>
                            </div>
                        </div>   
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mt-2">
                <div class="card dashboard-chart">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate mb-2">Monthly Grand Total</p>
                                <h4 class="mb-2">{{ '$'. ($data['totalBalanceReports']['monthlyReport']) - ($data['monthlyTotalExpanse']) ?? 0  }}</h4>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title rounded-3">
                                    <i class="fa-solid fa-file-invoice-dollar icon"></i>
                                </span>
                            </div>
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-12 mt-4 report-card">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card balance-card">
                    <div class="card-body">
                        <h2 class="text-center">Yearly Grand Report</h2>
                        <h5 class="text-center">Total Income: ${{ ($data['totalBalanceReports']['yearlyReport']) - ($data['totalExpanse']) ?? 0 }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                <div class="card balance-card">
                    <div class="card-body">
                        <h2 class="text-center">Monthly Balance</h2>
                        <h5 class="text-center">Total: ${{ $data['totalBalanceReports']['monthlyReport'] ?? 0 }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                <div class="card balance-card">
                    <div class="card-body">
                        <h2 class="text-center">Today Balance</h2>
                        <h5 class="text-center">Total: ${{ $data['totalBalanceReports']['todayReport'] ?? 0 }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                <div class="card balance-card">
                    <div class="card-body">
                        <h2 class="text-center">Total Expanse</h2>
                        <h5 class="text-center">Total: ${{ $data['totalExpanse'] ?? 0 }}</h5>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection