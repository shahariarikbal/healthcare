@extends('admin.master')

@section('content')
    <div class="container-fluid mt-3">
          <div class="col-md-12">
               <div class="card">
                    <div class="card-header">
                          Patient list
                          @if (auth()->guard('web')->check() || auth()->guard('receptionist')->check())
                            <a href="{{ route('patient.create') }}" class="btn btn-sm float-end btn-add">
                                <i class="fa-solid fa-circle-plus"></i> Add
                            </a>
                          @endif
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-data custom-font-size">
                          <thead>
                              <tr>
                                 <th class="sl-width">SL</th>
                                 <th>Name</th>
                                 <th>Phone</th>
                                 <th>Email</th>
                                 <th>Address</th>
                                 @if (auth()->guard('web')->check() || auth()->guard('receptionist')->check())
                                    <th>Action</th>
                                 @endif
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
                ajax: "{{ route('patient.manage') }}",
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
                        data: null,
                        name: 'name', // Change the name to 'name' to avoid confusion
                        render: function (data, type, row) {
                            // Customize the display format as needed
                            
                                return '<strong>' + data.name + '</strong>'
                        }
                    },
                    {data: 'phone', name: 'phone'},
                    {data: 'email', name: 'email'},
                    {data: 'address', name: 'address'},
                    @if (auth()->guard('web')->check() || auth()->guard('receptionist')->check())
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    @endif
                ]
            });

});

</script>
@endpush