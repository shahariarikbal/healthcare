<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Money receipt</title>
    <style>
        .container{
            height: auto;
            margin: auto;
            width: 50%;
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
        }

        .left-box{
            text-align: left;
            width: 50%;
        }

        .table th td{
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table{
            width: 100%;
            border-collapse: collapse;
        }

        .thead-bg-color{
            background-color: lightblue;
        }

        thead > tr {
            height: 35px;
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
    </style>
</head>
<body>
    <div class="container">
        <table class="header">
            <tbody>
                <tr>
                    <td class="left-box">
                        <h4>To</h4>
                        <p>Abdur rahman</p>
                        <p>Email: abdur@rahman.com</p>
                        <p>Phone: 01309608232</p>
                    </td>
                    <td class="right-box">
                        <img src="{{ asset(App\Constants\Statics::DEFAULT_LOGO_SET) }}" class="logo" />
                        <p>InvoiceID# HC0013</p>
                        <p>Issue date: 02/10/2024</p>
                        <p>Status: <small>Paid</small></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table">
            <thead class="thead-bg-color">
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Doctor</th>
                    <th>Payment type</th>
                    <th>Amount</th>
                </tr>
            </thead>

            <tbody>
                <tr class="items">
                    <td>#</td>
                    <td>02/10/2024</td>
                    <td>Abdur rahman</td>
                    <td>CASH</td>
                    <td>$1000</td>
                </tr>
                <tr class="total-section">
                    <td colspan="4"></td>
                    <td>Total : $1000</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>