@extends('admin.master')

@section('content')
    <div class="container mt-3">
          <div class="col-md-10">
               <div class="card view-card-shadow">
                    <div class="card-header hc-header-outer">
                        <h4 class="hc-header-title">
                            Accounts Profile details
                        </h4> 
                        <a href="{{ route('accounts.manage') }}" class="btn btn-sm btn-manage">Manage</a>
                    </div>
                    <div class="card-body">
                         <div class="doctor-details">
                            @if($accounts->avatar)
                            <img src="{{ asset($accounts->avatar) }}" class="details-view-avatar" />
                            @else
                            <img src="{{ asset(App\Constants\Statics::DEFAULT_IMAGE_SET) }}" class="avatar-size" />
                            @endif
                              
                              <div class="details-info">
                                  <span class="name">Name: {{ $accounts->full_name ?? 'accounts name' }}</span>
                                  <span class="experience">Experience: {{ $accounts->experience ?? 'Experience' }} Years</span>
                                  <span class="detail">Blood group : {{ $accounts->blood_group ?? 'NA' }}</span>
                              </div>
                          </div>
                          <div class="doctor-other-details">
                              <div class="column">
                                  <span class="detail"><b>Email : </b> {{ $accounts->email ?? 'Email' }}</span>
                                  <span class="detail"><b>Phone : </b>{{ $accounts->phone ?? 'Phone' }}</span>
                                  <span class="detail"><b>Gender : </b> {{ $accounts->gender ?? 'Gender' }}</span>
                              </div>
                              <div class="column">
                                <span class="detail"><b>Joining date : </b> {{ $accounts->join_date ?? 'Joining date' }}</span>
                                  <span class="detail"><b>Qualification : </b> {{ $accounts->qualification ?? 'Qualification' }}</span>
                                  <span class="detail"><b>Status : </b> 
                                     @if($accounts->is_active === 1)
                                        <small class="badge-active">Active</small>
                                     @else
                                        <small class="badge-inactive">Inactive</small>
                                     @endif
                                  </span>
                              </div>
                              <div class="column">
                                <span class="detail"><b>Date of birth : </b> {{ $accounts->dob ?? 'Date of birth' }}</span>
                                   <span class="detail"><b>Address : </b> {{ $accounts->address ?? 'Address' }}</span>
                              </div>
                          </div>                 
                    </div>
               </div>
          </div>
    </div>
@endsection