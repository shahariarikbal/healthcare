@extends('admin.master')

@section('content')
    <div class="container mt-3">
          <div class="col-md-10">
               <div class="card view-card-shadow">
                    <div class="card-header">
                          Prescription
                          <a href="{{ route('patient.manage') }}" class="btn btn-sm float-end btn-manage">Manage</a>
                    </div>
                    <div class="card-body">
                         <div class="doctor-details">
                              <img src="" class="details-view-avatar" />
                              <div class="details-info">
                                  <span class="name">Name: </span>
                                  <span class="specialist">Specialist: </span>
                                  <span class="experience">Experience:  Years</span>
                              </div>
                          </div>
                          <div class="doctor-other-details">
                              <div class="column">
                                  <span class="detail"><b>Email : </b> </span>
                                  <span class="detail"><b>Phone : </b></span>
                                  <span class="detail"><b>Gender : </b> </span>
                              </div>
                              <div class="column">
                                  <span class="detail"><b>Fee : </b> $</span>
                                  <span class="detail"><b>Qualification : </b> </span>
                                  <span class="detail"><b>Status : </b> 
                                     {{-- @if($doctor->is_active === 1)
                                        <small class="badge-active">Active</small>
                                     @else
                                        <small class="badge-inactive">Inactive</small>
                                     @endif --}}
                                  </span>
                              </div>
                              <div class="column">
                                   <span class="detail"><b>Address : </b> </span>
                              </div>

                              <div class="column-full">
                                  <span class="detail"><b>About : </b> </span>
                              </div>
                          </div>
                                                  
                    </div>
               </div>
          </div>
    </div>
@endsection