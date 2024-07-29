@extends('admin.master')

@section('content')
    <div class="container mt-3">
          <div class="col-md-10">
               <div class="card view-card-shadow">
                    <div class="card-header hc-header-outer">
                        <h4 class="hc-header-title">
                            Receptionist Profile details
                        </h4>  
                        <a href="{{ route('reception.manage') }}" class="btn btn-sm btn-manage">Manage</a>
                    </div>
                    <div class="card-body">
                         <div class="doctor-details">
                            @if($receptionist->avatar)
                            <img src="{{ asset($receptionist->avatar) }}" class="details-view-avatar" />
                            @else
                            <img src="{{ asset(App\Constants\Statics::DEFAULT_IMAGE_SET) }}" id="imagePreview" class="avatar-size" />
                            @endif
                              <div class="details-info">
                                  <span class="name">Name: {{ $receptionist->full_name ?? 'receptionist name' }}</span>
                                  <span class="experience">Experience: {{ $receptionist->experience ?? 'Experience' }} Years</span>
                                  <span class="detail">Blood group : {{ $receptionist->blood_group ?? 'NA' }}</span>
                              </div>
                          </div>
                          <div class="doctor-other-details">
                              <div class="column">
                                  <span class="detail"><b>Email : </b> {{ $receptionist->email ?? 'Email' }}</span>
                                  <span class="detail"><b>Phone : </b>{{ $receptionist->phone ?? 'Phone' }}</span>
                                  <span class="detail"><b>Gender : </b> {{ $receptionist->gender ?? 'Gender' }}</span>
                              </div>
                              <div class="column">
                                <span class="detail"><b>Joining date : </b> {{ $receptionist->join_date ?? 'Joining date' }}</span>
                                  <span class="detail"><b>Qualification : </b> {{ $receptionist->qualification ?? 'Qualification' }}</span>
                                  <span class="detail"><b>Status : </b> 
                                     @if($receptionist->is_active === 1)
                                        <small class="badge-active">Active</small>
                                     @else
                                        <small class="badge-inactive">Inactive</small>
                                     @endif
                                  </span>
                              </div>
                              <div class="column">
                                <span class="detail"><b>Date of birth : </b> {{ $receptionist->dob ?? 'Date of birth' }}</span>
                                   <span class="detail"><b>Address : </b> {{ $receptionist->address ?? 'Address' }}</span>
                              </div>
                          </div>                 
                    </div>
               </div>
          </div>
    </div>
@endsection