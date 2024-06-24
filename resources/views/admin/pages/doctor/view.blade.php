@extends('admin.master')

@section('content')
    <div class="container mt-3">
          <div class="col-md-10">
               <div class="card view-card-shadow">
                    <div class="card-header">
                          Doctor Profile details
                          <a href="{{ route('doctor.manage') }}" class="btn btn-sm float-end btn-manage">Manage</a>
                    </div>
                    <div class="card-body">
                         <div class="doctor-details">
                            @if($doctor->avatar)
                            <img src="{{ asset($doctor->avatar) }}" class="details-view-avatar" />
                            @else
                            <img src="{{ asset(App\Constants\Statics::DEFAULT_IMAGE_SET) }}" class="avatar-size" />
                            @endif
                              
                              <div class="details-info">
                                  <span class="name">Name: {{ $doctor->full_name ?? 'Doctor name' }}</span>
                                  <span class="specialist">Specialist: {{ $doctor->department?->name ?? 'Specialist' }}</span>
                                  <span class="experience">Experience: {{ $doctor->experience ?? 'Experience' }} Years</span>
                              </div>
                          </div>
                          <div class="doctor-other-details">
                              <div class="column">
                                  <span class="detail"><b>Email : </b> {{ $doctor->email ?? 'Email' }}</span>
                                  <span class="detail"><b>Phone : </b>{{ $doctor->phone ?? 'Phone' }}</span>
                                  <span class="detail"><b>Gender : </b> {{ $doctor->gender ?? 'Gender' }}</span>
                              </div>
                              <div class="column">
                                  <span class="detail"><b>Fee : </b> ${{ $doctor->fee ?? 'Fee' }}</span>
                                  <span class="detail"><b>Qualification : </b> {{ $doctor->qualification ?? 'Qualification' }}</span>
                                  <span class="detail"><b>Status : </b> 
                                     @if($doctor->is_active === 1)
                                        <small class="badge-active">Active</small>
                                     @else
                                        <small class="badge-inactive">Inactive</small>
                                     @endif
                                  </span>
                              </div>
                              <div class="column">
                                   <span class="detail"><b>Address : </b> {{ $doctor->address ?? 'Address' }}</span>
                              </div>

                              <div class="column-full">
                                  <span class="detail"><b>About : </b> {{ $doctor->about ?? 'About' }}</span>
                              </div>
                          </div>
                                                  
                    </div>
               </div>
          </div>
    </div>
@endsection