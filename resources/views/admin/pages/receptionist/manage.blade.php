@extends('admin.master')

@section('content')
    <div class="container-fluid mt-3">
          <div class="col-md-12">
               <div class="card">
                    <div class="card-header hc-header-outer">
                        <h4 class="hc-header-title">
                            Receptionist list
                        </h4>                        
                        @if (auth()->guard('web')->check())
                            <a href="{{ route('reception.create') }}" class="btn btn-sm btn-add">
                                <i class="fa-solid fa-circle-plus"></i> Add
                            </a>
                        @endif
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
                ajax: "{{ route('reception.manage') }}",
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
                            var receptionistActiveUrl = "{{ route('reception.active', ['id' => ':id']) }}"; 
                            var receptionistInactiveUrl = "{{ route('reception.inactive', ['id' => ':id']) }}";

                           
                            receptionistActiveUrl = receptionistActiveUrl.replace(':id', data.id);
                            receptionistInactiveUrl = receptionistInactiveUrl.replace(':id', data.id);
                            @if (auth()->guard('web')->check())
                                if (data.is_active === 1) {
                                    activeBtn = '<a href="' + receptionistActiveUrl + '" class="badge-active">Active</a>';
                                } else {
                                    inactiveBtn = '<a href="' + receptionistInactiveUrl + '" class="badge-inactive">Inactive</a>';
                                }
                            @else
                                if (data.is_active === 1) {
                                        activeBtn = '<a href="#" class="badge-active">Active</a>';
                                    } else {
                                        inactiveBtn = '<a href="#" class="badge-inactive">Inactive</a>';
                                }
                            @endif
                            

                            return activeBtn + ' ' + inactiveBtn;
                        }
                    },
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

});

</script>
@endpush