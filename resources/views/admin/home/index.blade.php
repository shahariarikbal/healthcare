@extends('admin.master')

@section('content')
<div class="row py-2">
          <div class="col-xl-3 col-md-6">
              <div class="card total-appointment">
                  <div class="card-body">
                      <div class="d-flex">
                          <div class="flex-grow-1">
                              <p class="text-truncate mb-2 text-white">Total Appointment</p>
                              <h4 class="mb-2 text-white">{{ $totalAppointments ?? 0 }}</h4>
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
          <div class="col-xl-3 col-md-6">
              <div class="card today-appointment">
                  <div class="card-body">
                      <div class="d-flex">
                          <div class="flex-grow-1">
                              <p class="text-truncate mb-2 text-white">Today Appointment</p>
                              <h4 class="mb-2 text-white">{{ $todayAppointments ?? 0 }}</h4>
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
          <div class="col-xl-3 col-md-6">
              <div class="card departments">
                  <div class="card-body">
                      <div class="d-flex">
                          <div class="flex-grow-1">
                              <p class="text-truncate mb-2 text-white">Patients</p>
                              <h4 class="mb-2 text-white">{{ $patients ?? 0 }}</h4>
                          </div>
                          <div class="avatar-sm">
                              <span class="avatar-title rounded-3">
                                <i class="fa-solid fa-bed-pulse"></i>
                              </span>
                          </div>
                      </div>                                              
                  </div><!-- end cardbody -->
              </div><!-- end card -->
          </div><!-- end col -->
          <div class="col-xl-3 col-md-6">
              <div class="card doctors">
                  <div class="card-body">
                      <div class="d-flex">
                          <div class="flex-grow-1">
                              <p class="text-truncate mb-2 text-white">Doctors</p>
                              <h4 class="mb-2 text-white">{{ $doctors ?? 0 }}</h4>
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
      </div>
@endsection