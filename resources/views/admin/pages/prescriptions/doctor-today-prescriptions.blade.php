@extends('admin.master')

@section('content')
    <div class="container mt-3">
          <div class="col-md-12">
               <div class="card">
                    <div class="card-header hc-header-outer">
                        <h4 class="hc-header-title">
                            Daily Prescriptions list
                        </h4>                        
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-data custom-font-size">
                          <thead>
                              <tr>
                                 <th class="sl-width">SL</th>
                                 <th>Avatar</th>
                                 <th>Name</th>
                                 <th>Phone</th>
                                 <th>Gender</th>
                                 <th>Experience</th>
                                 <th>Status</th>
                                 <th>Action</th>
                              </tr>
                         </thead>
                         <tbody>

                         </tbody>
                       </table>
                    </div>
               </div>
          </div>
    </div>
@endsection

@push('script')

@endpush