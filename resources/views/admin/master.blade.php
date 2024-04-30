<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>
    @include('admin.includes.style')
</head>
<body>
    <section class="main-wrapper">
        
        <!-- Sidebar include file  -->
        @include('admin.includes.sidebar')
        <!-- Sidebar include file  -->
        <div class="wrapper">
            <!-- page directory start-->
            @include('admin.includes.header')
            
            <!-- page directory end -->
            <main class="main">

                <!-- Cards srart -->
                @yield('content')
                <!-- Cards end -->

                <!-- your content goes here -->

            </main>
        </div>

    </section>
    @include('admin.includes.script')
</body>
</html>