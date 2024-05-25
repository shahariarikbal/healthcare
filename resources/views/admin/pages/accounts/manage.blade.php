@extends('admin.master')

@section('content')
    <div class="container mt-3">
          <div class="col-md-12">
               <div class="card">
                    <div class="card-header">
                        Accounts list
                          <a href="{{ route('accounts.create') }}" class="btn btn-sm float-end btn-add">
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
<script type="text/javascript">
          $(function () {
            var table = $('.table-data').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('accounts.manage') }}",
                columns: [
                    // SL number
                    { 
                        data: null,
                        name: 'id',
                        render: function(data, type, row, meta) {
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
                    
                    {
                        data: null,
                        name: 'full_name',
                        render: function (data, type, row) {
                            // Display name formated
                                return '<strong>' + data.first_name + ' ' + data.last_name + '</strong>'
                                
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
                            return '<p>' + data + " years" +'</p>';
                        }
                    },
                    
                    {
                        data: null,
                        name: 'is_active',
                        render: function(data, type, row) {
                            var activeBtn = '';
                            var inactiveBtn = '';
                            var accountsActiveUrl = "{{ route('accounts.active', ['id' => ':id']) }}"; 
                            var accountsInactiveUrl = "{{ route('accounts.inactive', ['id' => ':id']) }}";

                           
                            accountsActiveUrl = accountsActiveUrl.replace(':id', data.id);
                            accountsInactiveUrl = accountsInactiveUrl.replace(':id', data.id);

                            if (data.is_active === 1) {
                                activeBtn = '<a href="' + accountsActiveUrl + '" class="badge-active">Active</a>';
                            } else {
                                inactiveBtn = '<a href="' + accountsInactiveUrl + '" class="badge-inactive">Inactive</a>';
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