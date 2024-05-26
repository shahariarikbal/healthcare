@extends('admin.master')

@section('content')
    <div class="container mt-3">
          <div class="col-md-12">
               <div class="card">
                    <div class="card-header">
                          Doctors
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-data custom-font-size">
                          <thead>
                              <tr>
                                 <th class="sl-width">SL</th>
                                 <th>Avatar</th>
                                 <th>Name</th>
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
                ajax: "{{ route('doctor.list') }}",
                columns: [
                    // Serial number column
                    { 
                        data: null,
                        name: 'id',
                        render: function(data, type, row, meta) {
                            // Calculate the serial number using the row index
                            return meta.row + 1;
                        }
                    },

                    {
                        data:null,
                        name:'avatar',
                        render: function (data, type, row){
                            return '<img src="' + data.avatar + '" class="avatar">'
                        }
                    },
                    // Custom rendering function for the 'first_name' column
                    {
                        data: null,
                        name: 'full_name', // Change the name to 'full_name' to avoid confusion
                        render: function (data, type, row) {
                            // Customize the display format as needed
                            
                                return '<strong>' + data.first_name + ' ' + data.last_name + '</strong>' +
                                '<p>' + data.department.name + '</p>'
                        }
                    },
                    
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

});

</script>
@endpush