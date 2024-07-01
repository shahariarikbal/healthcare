<!DOCTYPE html>
<html>
<head>
    <title>{{ $appointment['subject'] }}</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/email-template.css') }}" />
</head>
<body>
    <div class="container">
        <img src="{{ asset(App\Constants\Statics::DEFAULT_LOGO_SET) }}" class="logo" />
        <div class="content">
            <p class="heading">Dear {{ $appointment['patient']['name'] }} Good day !</p>
            <p class="pera">
                We are pleased to confirm your appointment with 
                <b>Dr.{{ $appointment['doctor']['first_name'] . ' ' . $appointment['doctor']['last_name'] }}</b> 
                on <b>{{ $appointment['appointment_date'] }}</b> <br/>
                Please arrive 10 minutes early and bring any necessary documents.<br/>
                if you need to reschedule or have any questions, feel free to contact us.<br/>
                Looking forward to seeing you. <br/><br/>

                Best regards,<br/>
                <b>Health Care</b>
            </p>
        </div>
    </div>
</body>
</html>