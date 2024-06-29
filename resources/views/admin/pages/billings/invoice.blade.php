<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Money receipt</title>
  <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/invoice.css') }}"/>
</head>
<body>
  <div class="container print-container">
    <div class="row mt-4">
        <div class="col-lg-10 col-md-10 col-sm-12 receipt-body">
          <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12 patient-info">
              <span class="text-gray-600 align-middle">To:</span>
              <span class="text-primary align-middle">{{ $invoice->patient?->name }}</span>
              <p class="text-gray-600 align-middle">
                <i class="fa-solid fa-envelope"></i> {{ $invoice->patient?->email ?? 'N/A' }}
              </p>

              <p class="text-gray-600 align-middle">
                <i class="fa-solid fa-phone"></i> {{ $invoice->patient?->phone ?? 'N/A' }}
              </p>

            </div>
            <div class="col-lg-5 col-md-5 col-sm-12 text-end invoice-info">
              <span class="text-gray-600 align-middle">InvoiceID</span> #
              <span class="text-primary align-middle">{{ $invoice->invoiceId ?? 'N/A' }}</span>
              <p class="text-gray-600 align-middle">
                Issue Date: {{ date('M d, Y', strtotime($invoice->created_at)) }}
              </p>

              <p class="text-gray-600 align-middle">
                Status: <span class="badge bg-primary">Paid</span>
              </p>
            </div>
          </div>
          <table class="table table-bordered">
            <tr>
              <th>#</th>
              <th>Payment Date</th>
              <th>Doctor name</th>
              <th>Patient name</th>
              <th>Payment type</th>
              <th>Amount</th>
            </tr>
            <tr>
              <td>1</td>
              <td>{{ $invoice->payment_date ?? 'N/A' }}</td>
              <td>{{ $invoice->doctor?->full_name ?? 'N/A' }}</td>
              <td>{{ $invoice->patient?->name }}</td>
              <td>{{ Str::ucfirst($invoice->payment_type) }}</td>
              <td>${{ $invoice->doctor?->fee ?? '0' }}</td>
            </tr>
          </table>
        </div>
    </div>
  </div>
  <script>
    window.onload = function() {
        window.print();
        setTimeout(function(){
          window.location.href = document.referrer
        }, 1000)
    };
  </script>
</body>
</html>