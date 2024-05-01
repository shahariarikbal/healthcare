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
    @stack('script')

    @if(session('success'))
        <script>
            Toastify({
                text: '{{ session('success') }}',
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: "linear-gradient(to right, #00b09b, #96c93d)",
                },
                onClick: function(){} // Callback after click
                }).showToast();
        </script>
    @endif

    @if(session('error'))
        <script>
            Toastify({
                text: '{{ session('error') }}',
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "left", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: "linear-gradient(to right, #00b09b, #96c93d)",
                },
                onClick: function(){} // Callback after click
                }).showToast();
        </script>
    @endif
</body>
</html>