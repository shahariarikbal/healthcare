@extends('doctor.master')

@section('content')
    <div class="container mt-3">
          <div class="col-md-12">
               <div class="card">
                    <div class="card-header hc-header-outer">
                        <h4 class="hc-header-title">
                          All Prescriptions list
                        </h4>                         
                    </div>
                    <div class="card-body">
                        
                        <table class="table table-hover table-data custom-font-size">
                          <thead>
                              <tr>
                                 <th class="sl-width">SL</th>
                                 <th class="sl-width">Date</th>
                                 <th>Patient name</th>
                                 <th>Phone</th>
                                 <th>Gender</th>
                                 <th>Age</th>
                                 <th class="sl-width">Action</th>
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
<script type="text/javascript">
    $(function () {
            
            var table = $('.table-data').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('prescription.auth.doctor.list') }}",
                columns: [
                    {
                      data: null, 
                      name: 'id',
                      render: function(data, type, row, meta){
                        return meta.row + 1
                      }
                    },

                    {
                      data: null, 
                      name: 'created_at',
                      render: function(data, type, row){
                        let dateTimeData = new Date(data.created_at);
                        return dateTimeData.toLocaleDateString();
                      }
                    },

                    {
                      data: 'patient', 
                      name: 'patient.name',
                      render: function(data, type, row){
                        return row.patient.name; '<strong> Call: ' + row.patient.phone +'</strong>'
                      }
                    },

                    {
                      data: 'patient', 
                      name: 'patient.phone',
                      render: function(data, type, row){
                        return row.patient.phone;
                      }
                    },

                    {
                      data: null, 
                      name: 'gender',
                      render: function(data, type, row){
                        return data.gender;
                      }
                    },

                    {
                      data: null, 
                      name: 'age',
                      render: function(data, type, row){
                        return data.age + ' Years';
                      }
                    },

                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            
          });
</script>
@endpush