@extends('admin.master')

@section('content')
    <div class="container mt-3">
          <div class="col-md-12">
               <div class="card">
                    <div class="card-header">
                          Department list
                          <a href="{{ route('department.create') }}" class="btn btn-sm float-end btn-add">
                              <i class="fa-solid fa-circle-plus"></i> Add
                          </a>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-data">
                          <thead>
                              <tr>
                                 <th class="table-sl">SL</th>
                                 <th>Name</th>
                                 <th class="table-action">Action</th>
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
                ajax: "{{ route('department.manage') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            
          });
</script>
@endpush