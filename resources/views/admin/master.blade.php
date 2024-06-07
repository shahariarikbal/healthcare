<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>
    @include('admin.includes.style')
    @stack('style')
    
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

    <script>
        //Image preview js code
        function imageChange(e){
        if (e.target.files[0]) {
            let image = e.target.files[0];
            if(image['type'] === 'image/jpeg' || image['type'] === 'image/png' || image['type'] === 'image/webp' || image['type'] === 'image/gif'){
                let reader = new FileReader();
                reader.onload = function ()
                {
                    let output = document.getElementById('imagePreview');
                    output.src = reader.result;
                    output.style.display = "block";
                    output.style.width = "20%";
                }
                reader.readAsDataURL(event.target.files[0]);
            }else{
                alert('Please input e valid image.');
            }
        }
    }
    </script>

    @if(session('success'))
        <script>
            Toastify({
                text: '{{ session('success') }}',
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "top", 
                position: "right",
                stopOnFocus: true, 
                style: {
                    background: "linear-gradient(to right, #00b09b, #96c93d)",
                },
                onClick: function(){}
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
                className: "error",
                gravity: "top",
                position: "right",
                stopOnFocus: true,
                style: {
                    background: "linear-gradient(to right, #FF512F 0%, #DD2476  51%, #FF512F  100%)",
                },
                onClick: function(){}
                }).showToast();
        </script>
    @endif
</body>
</html>