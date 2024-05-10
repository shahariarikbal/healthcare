@extends('admin.master')

@section('content')
    <div class="container mt-3">
          <div class="col-md-12">
               <div class="card">
                    <div class="card-header">
                          Doctor list
                          <a href="{{ route('doctor.create') }}" class="btn btn-sm float-end btn-add">
                              <i class="fa-solid fa-circle-plus"></i> Add
                          </a>
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
                                 <th>Exp</th>
                                 <th>Fee</th>
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
                ajax: "{{ route('doctor.manage') }}",
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
                    {
                        data: null, 
                        name: 'phone',
                        render: function(data, type, row) {
                            return '<p>' + data.phone +'</p>';
                        }
                    },
                    {data: 'gender', name: 'gender'},
                    {
                        data: 'experience',
                        name: 'experience',
                        render: function(data, type, row) {
                            return '<p>' + data + " years" +'</p>'; // Append "years" to the experience value
                        }
                    },
                    {
                        data: 'fee',
                        name: 'fee',
                        render: function(data, type, row) {
                            return '$' + data; // Add the "$" symbol before the fee value
                        }
                    },
                    {
                        data: null,
                        name: 'is_active',
                        render: function(data, type, row) {
                            var activeBtn = '';
                            var inactiveBtn = '';
                            var doctorActiveUrl = "{{ route('doctor.active', ['id' => ':id']) }}"; // Add ':id' as a placeholder
                            var doctorInactiveUrl = "{{ route('doctor.inactive', ['id' => ':id']) }}"; // Add ':id' as a placeholder

                            // Replace ':id' placeholder with the actual id value
                            doctorActiveUrl = doctorActiveUrl.replace(':id', data.id);
                            doctorInactiveUrl = doctorInactiveUrl.replace(':id', data.id);

                            if (data.is_active === 1) {
                                activeBtn = '<a href="' + doctorActiveUrl + '" class="badge-active">Active</a>';
                            } else {
                                inactiveBtn = '<a href="' + doctorInactiveUrl + '" class="badge-inactive">Inactive</a>';
                            }

                            return activeBtn + ' ' + inactiveBtn;
                        }
                    },
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

});

</script>
@endpush