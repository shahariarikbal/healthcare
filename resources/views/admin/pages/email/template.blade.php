<!DOCTYPE html>
<html>
<head>
    <title>{{ $dynamicData['subject'] }}</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/email-template.css') }}" />
</head>
<body>
   
<div class="container">
    <img src="{{ asset(App\Constants\Status::DEFAULT_IMAGE_SET) }}" class="logo" />
    <div class="content">
        <p class="heading">Hi {{ $dynamicData['name'] }} Good day !</p>
        <p class="pera">
            {{ $dynamicData['body'] }}
        </p>
    </div>
</div>
  

  
</body>
</html>