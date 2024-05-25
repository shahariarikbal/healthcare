@extends('admin.master')

@section('content')
    <div class="container mt-3">
          <div class="col-md-10">
               <div class="card view-card-shadow">
                    <div class="card-header">
                          Nurse Profile details
                          <a href="{{ route('nurse.manage') }}" class="btn btn-sm float-end btn-manage">Manage</a>
                    </div>
                    <div class="card-body">
                         <div class="doctor-details">
                              <img src="{{ asset($nurse->avatar) }}" class="details-view-avatar" />
                              <div class="details-info">
                                  <span class="name">Name: {{ $nurse->full_name ?? 'Nurse name' }}</span>
                                  <span class="experience">Experience: {{ $nurse->experience ?? 'Experience' }} Years</span>
                              </div>
                          </div>
                          <div class="doctor-other-details">
                              <div class="column">
                                  <span class="detail"><b>Email : </b> {{ $nurse->email ?? 'Email' }}</span>
                                  <span class="detail"><b>Phone : </b>{{ $nurse->phone ?? 'Phone' }}</span>
                                  <span class="detail"><b>Gender : </b> {{ $nurse->gender ?? 'Gender' }}</span>
                              </div>
                              <div class="column">
                                  <span class="detail"><b>Qualification : </b> {{ $nurse->qualification ?? 'Qualification' }}</span>
                                  <span class="detail"><b>Status : </b> 
                                     @if($nurse->is_active === 1)
                                        <small class="badge-active">Active</small>
                                     @else
                                        <small class="badge-inactive">Inactive</small>
                                     @endif
                                  </span>
                              </div>
                              <div class="column">
                                   <span class="detail"><b>Address : </b> {{ $nurse->address ?? 'Address' }}</span>
                              </div>
                          </div>                 
                    </div>
               </div>
          </div>
    </div>
@endsection