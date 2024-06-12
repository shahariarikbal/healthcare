@extends('admin.master')

@section('content')
    <div class="container-fluid mt-3">
          <div class="col-md-12">
               <div class="card">
                    <div class="card-header">
                        Expanse list
                          <a href="{{ route('expanse.create') }}" class="btn btn-sm float-end btn-add">
                              <i class="fa-solid fa-circle-plus"></i> Add
                          </a>
                    </div>
                    <div class="card-body">
                        <table id="expanse-list" class="table table-hover table-data custom-font-size">
                          <thead>
                              <tr>
                                 <th class="sl-width">SL</th>
                                 <th>Date</th>
                                 <th>Purpose</th>
                                 <th>Amount</th>
                                 <th>Image</th>
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
            
    </script>
@endpush