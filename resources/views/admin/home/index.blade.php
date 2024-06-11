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
    <div class="col-lg-8 col-md-8 col-sm-12 mt-4">
        <div class="card dashboard-card">
            <div class="card-body">
                <canvas id="appointment_report"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 mt-4">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <h2 class="text-center">Yearly Income</h2>
                        <h4 class="text-center">Patient: 560000</h4>
                        <h4 class="text-center">Income: $560000</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <h2 class="text-center">Monthly Income</h2>
                        <h4 class="text-center">$56000</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <h2 class="text-center">Today Income</h2>
                        <h4 class="text-center">$46000</h4>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    //Monthly appointment report chart
    let labels =  {{ Js::from($labels) }};
    let appointmentData =  {{ Js::from($data) }};
  
    const chartData = {
        labels: labels,
        datasets: [{
            label: "{{ date('Y') }} Monthly appointment report",
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: 'rgb(255, 99, 132)',
            data: appointmentData,
        }]
    };
  
    const barChartConfig = {
        type: 'bar',
        data: chartData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };
  
    const monthly_sales_report = new Chart(
        document.getElementById('appointment_report'),
        barChartConfig
    );
  
  </script>
@endpush