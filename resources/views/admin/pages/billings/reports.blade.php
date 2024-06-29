@extends('admin.master')

@section('content')
    <div class="container-fluid mt-2">
          <div class="col-md-12">
               <div class="card">
                    <div class="card-header">
                        Payments report list
                    </div>
                    <div class="card-body">
                      <div class="input-group date-filtering">
                        <input type="date" aria-label="From date" name="from_date" id="from_date" class="form-control">
                        <input type="date" aria-label="To date" name="to_date" id="to_date" class="form-control">
                        <select class="form-control" name="payment_type" id="payment_type">
                          <option selected disabled>Payment type</option>
                          <option value="cash">Cash</option>
                          <option value="card">Card</option>
                        </select>
                        <button type="button" id="filter-btn">
                          <span class="input-group-text filter-btn">Filter</span>
                        </button>
                        <button type="button" id="refresh-btn">
                          <span class="input-group-text refresh-btn">Refresh</span>
                        </button>
                      </div>
                      <div class="expanse-box">
                        <p>Total payment: $0</p>
                      </div>
                        <table class="table table-hover table-data custom-font-size">
                          <thead>
                              <tr>
                                 <th class="sl-width">SL</th>
                                 <th>Invoice No</th>
                                 <th>Doctor</th>
                                 <th>Patient</th>
                                 <th>Payment date</th>
                                 <th>Payment Type</th>
                                 <th class="text-center">Amount</th>
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
            url: "{{ route('accounts.payment.report.manage') }}",
            data: function(d){
              d.from_date = $('#from_date').val();
              d.to_date = $('#to_date').val();
              d.payment_type = $('#payment_type').val();
            },
            dataSrc: function(json){
                $('.expanse-box p').text('Total payment: $' + json.fee);
                return json.data;
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
                  data: null,
                  name: 'invoiceId',
                  render: function(data, type, row, meta) {
                      return data.invoiceId;
                  }
              },
             
              {
                  data: 'doctor.first_name',
                  name: 'doctor.last_name',
                  render: function (data, type, row) {
                          return '<strong>' + row.doctor.first_name + ' ' + row.doctor.last_name + '</strong>'
                  }
              },
              {
                  data: 'patient.name', 
                  name: 'patient.name',
                  render: function(data, type, row) {
                      return '<strong>' + row.patient.name +'</strong>';
                  }
              },
              {data: 'payment_date', name: 'payment_date'},

              {data: 'payment_type', name: 'payment_type'},

              {
                data: 'fee', 
                name: 'fee',
                render:function(data, type, row){
                  return '<p class="text-center"> $' + data + '</p>'
                }
            },
              
          ]
      });

      $('#filter-btn').on('click', function(){
        table.draw();
      });

      $('#refresh-btn').on('click', function(){
        $('#from_date').val('');
        $('#to_date').val('');
        $('#payment_type').val('');
        table.draw();
      })

});

    function downloadInvoice(event){
      window.location.href = event.target.href
    }

</script>
@endpush