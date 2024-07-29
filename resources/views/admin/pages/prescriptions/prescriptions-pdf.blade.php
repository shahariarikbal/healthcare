<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prescription</title>
    <style>
        .container{
            height: auto;
            margin: auto;
            width: 100%;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .header{
            width: 100%;
            padding: 20px;
        }

        .right-box{
            text-align: right;
            width: 50%;
            font-size: 14px;
        }

        .left-box{
            text-align: left;
            width: 50%;
            font-size: 14px;
        }

        .table th td{
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table{
            width: 100%;
            border-collapse: collapse;
        }

        .table-border{
            border: 1px solid gray;
        }

        .thead-bg-color{
            background-color: lightblue;
        }

        thead > tr {
            height: 25px;
        }

        .items{
            text-align: center;
        }

        .total-section{
            text-align: center;
            font-weight: 600;
        }
        small{
            font-size: 17px;
            background-color: #91f791;
            padding: 5px;
            border-radius: 20%;
        }

        .mt-20{
            margin-top: 20px
        }

        .col-60{
            width: 60%;
        }

        .col-60 p{
            text-align: justify;
            padding: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <table class="header">
            <tbody>
                <tr>
                    <td class="left-box">
                        <h4>Doctor Info</h4>
                        <p>{{ $instruction->doctor?->full_name ?? 'NA' }}</p>
                        <p>Email: {{ $instruction->doctor?->email ?? 'NA' }}</p>
                        <p>Phone: {{ $instruction->doctor?->phone ?? 'NA' }}</p>
                    </td>
                    <td class="right-box">
                        <img src="{{ asset(App\Constants\Statics::DEFAULT_LOGO_SET) }}" />
                        <p>Address : H-8, R-3/E, Sector-9, Uttara, Dhaka, Bangladesh</p>
                        <p>Call: +8801309608232, +8801885131495</p>
                        <p>Email: health@info.com</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-border">
            <thead class="thead-bg-color">
                <tr class="items table-border">
                    <th class="table-border">Patient Info</th>
                    <th class="table-border">Symptoms/Instructions/Note</th>
                </tr>
            </thead>

            <tbody>
                <tr class="items table-border">
                    <td class="table-border">
                        <p>Name : {{ $instruction->patient?->name ?? 'NA' }}</p>
                        <p>Gender : {{ $instruction->gender ?? 'NA' }}</p>
                        <p>Age : {{ $instruction->age ?? 'NA' }} Years</p>
                        <p>Phone : {{ $instruction->patient?->phone ?? 'NA' }}</p>
                    </td>
                    <td class="table-border col-60">
                        <p>{{ $instruction->note ?? 'NA' }}</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-border mt-20">
            <thead class="thead-bg-color">
                <tr class="table-border">
                    <th class="sl-width">Sl</th>
                    <th>Medicine name</th>
                    <th>Dose</th>
                    <th>Durations</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($instruction->prescriptions as $prescription)
                    <tr class="items table-border">
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $prescription->medicine_name ?? 'NA' }}</td>
                        <td>{{ $prescription->dose ?? 'NA' }}</td>
                        <td>{{ $prescription->duration ?? 'NA' }} days</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>