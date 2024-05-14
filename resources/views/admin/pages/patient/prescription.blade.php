@extends('admin.master')

@section('content')
    <div class="container mt-3">
          <div class="col-md-12">
               <div class="card view-card-shadow">
                    <div class="card-header">
                          Prescription
                          <a href="#" class="btn btn-sm float-end btn-add" title="Download">
                            <i class="fa-solid fa-download"></i>
                          </a>
                          <a href="{{ route('patient.manage') }}" class="btn btn-sm float-end btn-manage">Manage</a>
                    </div>
                    <div class="card-body">
                         <div class="doctor-details">
                              <img src="{{ asset(App\Constants\Status::DEFAULT_IMAGE_SET) }}" class="details-view-avatar" />
                              <div class="details-info">
                                  <span class="name">Name: Md Shahariar ikbal</span>
                                  <span class="specialist">Specialist: Medicine</span>
                                  <span class="experience">Qualification:  MBBS, FCPS, FRCS</span>
                              </div>
                          </div>
                          <div class="col-lg-12 col-md-12 mt-4">
                              <div class="row">
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <span>Name: Md Shahariar ikbal</span>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <span>Phone: 01309608232</span>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <span>Age: 33 years</span>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <span>Date: {{ date('m/d/Y') }}</span>
                                </div>
                              </div>

                              <table class="table table-bordered mt-4">
                                <tr>
                                    <th class="sl-width">SL</th>
                                    <th>Drug</th>
                                    <th>Strength</th>
                                    <th>Days</th>
                                    <th>Frequency</th>
                                    <th>Remarks</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Tab. Napa Extra</td>
                                    <td>500mg</td>
                                    <td>21 days</td>
                                    <td>0+0+1</td>
                                    <td>After dinner</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Tab. Napa Extra</td>
                                    <td>500mg</td>
                                    <td>20 days</td>
                                    <td>0+0+1</td>
                                    <td>After dinner</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Tab. Napa Extra</td>
                                    <td>500mg</td>
                                    <td>11 days</td>
                                    <td>0+0+1</td>
                                    <td>After dinner</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Tab. Napa Extra</td>
                                    <td>500mg</td>
                                    <td>51 days</td>
                                    <td>0+0+1</td>
                                    <td>After dinner</td>
                                </tr>
                              </table>
                          </div>
                                                  
                    </div>
               </div>
          </div>
    </div>
@endsection