@extends('admin.master')

@section('content')
    <div class="container-fluid mt-3">
          <div class="col-md-12">
               <div class="card">
                    <div class="card-header hc-header-outer">
                        <h4 class="hc-header-title">
                            Expanse list
                        </h4>
                        <a href="{{ route('accounts.expanse.create') }}" class="btn btn-sm btn-add">
                            <i class="fa-solid fa-circle-plus"></i> Add
                        </a>
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
                          <div class="expanse-box">
                            <p>Total expanse: $0</p>
                          </div>
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
            $(function () {
            
            var table = $('.table-data').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('accounts.expanse.manage') }}",
                    data: function(d){
                        d.from_date = $('#from_date').val();
                        d.to_date = $('#to_date').val();
                    },
                    dataSrc: function(json){
                        $('.expanse-box p').text('Total expanse: $' + json.total_amount);
                        return json.data;
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'expanse_date', name: 'expanse_date'},
                    {data: 'purpose', name: 'purpose'},
                    {
                        data: 'amount', 
                        name: 'amount',
                        render:function(data, type, row){
                            return '$' + data
                        }
                    },
                    {
                        data: 'image', 
                        name: 'image',
                        render:function(data, type, row){
                            if(!data){
                                return 'N/A';
                            }
                            return '<img src="' + data + '" class="receipt-img">'
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