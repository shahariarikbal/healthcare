@extends('admin.master')

@section('content')
    <div class="container-fluid mt-2">
          <div class="col-md-12">
               <div class="card">
                    <div class="card-header">
                        Appointments list
                    </div>
                    <div class="card-body">
                      <div class="input-group date-filtering">
                        <input type="date" aria-label="From date" name="from_date" id="from_date" class="form-control">
                        <input type="date" aria-label="To date" name="to_date" id="to_date" class="form-control">
                        <button type="button" id="filter-btn">
                          <span class="input-group-text filter-btn">Filter</span>
                        </button>
                        <button type="button" id="refresh-btn">
                          <span class="input-group-text refresh-btn">Refresh</span>
                        </button>
                      </div>
                        <table class="table table-hover table-data custom-font-size">
                          <thead>
                              <tr>
                                 <th class="sl-width">SL</th>
                                 <th>Doctor</th>
                                 <th>Patient</th>
                                 <th>Appointment date</th>
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
<script type="text/javascript">
    $(function () {
      var table = $('.table-data').DataTable({
          processing: true,
          serverSide: true,
          ajax: {
            url: "{{ route('appointment.all') }}",
            data: function(d){
              d.from_date = $('#from_date').val();
              d.to_date = $('#to_date').val();
            }
          },
          
          columns: [
              // Serial number column
              { 
                  data: null,
                  name: 'id',
                  render: function(data, type, row, meta) {
                      return meta.row + 1;
                  }
              },
             
              {
                  data: 'doctor',
                  name: 'doctor.last_name',
                  render: function (data, type, row) {
                          return '<strong>' + row.doctor.first_name + ' ' + row.doctor.last_name + '</strong>' + '<br/>' + '<strong> Call: ' + row.doctor.phone +'</strong>'
                  }
              },
              {
                  data: 'patient', 
                  name: 'patient.name',
                  render: function(data, type, row) {
                      return '<strong>' + row.patient.name +'</strong>' + '<br/>' + '<strong> Call: ' + row.patient.phone +'</strong>';
                  }
              },
              {data: 'appointment_date', name: 'appointment_date'},

              {
                  data: 'status',
                  name: 'status',
                  render: function(data, type, row) {
                    var statuses = {
                      0: 'Pending',
                      1: 'Done',
                      2: 'Receptionist',
                      3: 'Accounts',
                      4: 'Absent',
                      5: 'Treatment',
                    };

                    var badgeClass = data == 0 || data == 4 ? 'badge-inactive' : 'badge-active';
                    return '<a href="#" class="'+ badgeClass +'">'+ statuses[data] + '</a>';
                  }
              },
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });

      $('#filter-btn').on('click', function(){
        table.draw();
      });

      $('#refresh-btn').on('click', function(){
        $('#from_date').val('');
        $('#to_date').val('');
        table.draw();
      })

});

</script>
@endpush