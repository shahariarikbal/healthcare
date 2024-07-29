@extends('doctor.master')

@section('content')
    <div class="container mt-3">
          <div class="col-md-12">
               <div class="card">
                    <div class="card-header">
                        View Prescription
                        <a href="{{ route('prescription.download.pdf', ['instruction' => $instruction->id]) }}" class="btn btn-sm float-end btn-manage"><i class="fa fa-download"></i> Download</a>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <p>
                                        <i class="fa fa-user"></i> Name : {{ $instruction->doctor?->full_name ?? 'NA' }}
                                    </p>
                                    <p>
                                        <i class="fa-solid fa-envelope"></i> E-mail : {{ $instruction->doctor?->email ?? 'NA' }}
                                    </p>
                                    <p>
                                        <i class="fa-solid fa-graduation-cap"></i> Qualifications : 
                                            <span class="badge-active">{{ $instruction->doctor?->qualification ?? 'NA' }}</span>
                                    </p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                                    <p>
                                        <i class="fa fa-home"></i> Address :  H-8, R-3/E, Sector-9, Uttara, Dhaka, Bangladesh
                                    </p>
                                    <p>
                                        <i class="fa fa-phone"></i> Call :  +8801309608232, +8801885131495
                                    </p>
                                    <p>
                                        <i class="fa-solid fa-envelope"></i> E-mail : health@info.com
                                    </p>
                                </div>
                            </div>
                            <hr/>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-label">Patient Info</div>
                                <p>Name : {{ $instruction->patient?->name ?? 'NA' }}</p>
                                <p>Gender : {{ $instruction->gender ?? 'NA' }}</p>
                                <p>Age : {{ $instruction->age ?? 'NA' }} Years</p>
                           </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="form-label">Symptoms/Instructions</div>
                                <p>{{ $instruction->note ?? 'NA' }}</p>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <table class="table table-bordered">
                                    <tr>
                                        <th class="sl-width">#</th>
                                        <th>Medicine name</th>
                                        <th>Dose</th>
                                        <th>Durations</th>
                                    </tr>
                                    @foreach ($instruction->prescriptions as $prescription)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $prescription->medicine_name ?? 'NA' }}</td>
                                            <td>{{ $prescription->dose ?? 'NA' }}</td>
                                            <td>{{ $prescription->duration ?? 'NA' }} days</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
               </div>
          </div>
    </div>
@endsection