<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <section class="main-wrapper">
        <div class="offcanvas offcanvas-start show" data-bs-scroll="false" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
            <div class="offcanvas-header justify-content-center">
                <a href="{{ route('admin.dashboard') }}">
                    <p class="brand-name">HCMS</p>
                </a>
            </div>
            <div class="offcanvas-body">
                <nav class="sidebar">
                    <ul class="nav flex-column" id="nav_accordion">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                <i class="fa-solid fa-house-chimney"></i>
                                Home
                            </a>
                        </li>
                        <li class="nav-item has-submenu">
                            <a class="nav-link" href="javascript:void(0);"> 
                                <i class="fa-solid fa-graduation-cap"></i>
                                Department <i class="fa-solid fa-chevron-down float-end"></i>
                            </a>
                            <ul class="submenu collapse">
                                <li><a class="nav-link" href="javascript:void(0);">item 1 </a></li>
                                <li><a class="nav-link" href="javascript:void(0);">item 2 </a></li>
                                <li><a class="nav-link" href="javascript:void(0);">item 3 </a> </li>
                            </ul>
                        </li>
                        <li class="nav-item has-submenu">
                            <a class="nav-link" href="javascript:void(0);">
                                <i class="fa-solid fa-user-doctor"></i>
                                 Doctor  <i class="fa-solid fa-chevron-down float-end"></i>
                            </a>
                            <ul class="submenu collapse">
                                <li><a class="nav-link" href="javascript:void(0);">item 4 </a></li>
                                <li><a class="nav-link" href="javascript:void(0);">item 5 </a></li>
                                <li><a class="nav-link" href="javascript:void(0);">item 6 </a></li>
                                <li><a class="nav-link" href="javascript:void(0);">item 7 </a></li>
                            </ul>
                        </li>
                        <li class="nav-item has-submenu">
                            <a class="nav-link" href="javascript:void(0);">
                                <i class="fa-solid fa-hospital-user"></i>
                                 Patient  <i class="fa-solid fa-chevron-down float-end"></i>
                            </a>
                            <ul class="submenu collapse">
                                <li><a class="nav-link" href="javascript:void(0);">item 4 </a></li>
                                <li><a class="nav-link" href="javascript:void(0);">item 5 </a></li>
                                <li><a class="nav-link" href="javascript:void(0);">item 6 </a></li>
                                <li><a class="nav-link" href="javascript:void(0);">item 7 </a></li>
                            </ul>
                        </li>
                        <li class="nav-item has-submenu">
                            <a class="nav-link" href="javascript:void(0);">
                                <i class="fa-solid fa-calendar-check"></i>
                                Appointment  <i class="fa-solid fa-chevron-down float-end"></i>
                            </a>
                            <ul class="submenu collapse">
                                <li><a class="nav-link" href="javascript:void(0);">item 4 </a></li>
                                <li><a class="nav-link" href="javascript:void(0);">item 5 </a></li>
                                <li><a class="nav-link" href="javascript:void(0);">item 6 </a></li>
                                <li><a class="nav-link" href="javascript:void(0);">item 7 </a></li>
                            </ul>
                        </li>
                        <li class="nav-item has-submenu">
                            <a class="nav-link" href="javascript:void(0);">
                                <i class="fa-solid fa-file-invoice-dollar"></i>
                                 Accounts  <i class="fa-solid fa-chevron-down float-end"></i>
                            </a>
                            <ul class="submenu collapse">
                                <li><a class="nav-link" href="javascript:void(0);">item 4 </a></li>
                                <li><a class="nav-link" href="javascript:void(0);">item 5 </a></li>
                                <li><a class="nav-link" href="javascript:void(0);">item 6 </a></li>
                                <li><a class="nav-link" href="javascript:void(0);">item 7 </a></li>
                            </ul>
                        </li>
                        <li class="nav-item has-submenu">
                            <a class="nav-link" href="javascript:void(0);">
                                <i class="fa-solid fa-prescription"></i>
                                Prescription  <i class="fa-solid fa-chevron-down float-end"></i>
                            </a>
                            <ul class="submenu collapse">
                                <li><a class="nav-link" href="javascript:void(0);">item 4 </a></li>
                                <li><a class="nav-link" href="javascript:void(0);">item 5 </a></li>
                                <li><a class="nav-link" href="javascript:void(0);">item 6 </a></li>
                                <li><a class="nav-link" href="javascript:void(0);">item 7 </a></li>
                            </ul>
                        </li>
                        <li class="nav-item has-submenu">
                            <a class="nav-link" href="javascript:void(0);">
                                <i class="fa-solid fa-user-tie"></i>
                                Receptionist  <i class="fa-solid fa-chevron-down float-end"></i>
                            </a>
                            <ul class="submenu collapse">
                                <li><a class="nav-link" href="javascript:void(0);">item 4 </a></li>
                                <li><a class="nav-link" href="javascript:void(0);">item 5 </a></li>
                                <li><a class="nav-link" href="javascript:void(0);">item 6 </a></li>
                                <li><a class="nav-link" href="javascript:void(0);">item 7 </a></li>
                            </ul>
                        </li>

                        <li class="nav-item has-submenu">
                            <a class="nav-link" href="javascript:void(0);">
                                <i class="fa-solid fa-comment-sms"></i>
                                Messaging  <i class="fa-solid fa-chevron-down float-end"></i>
                            </a>
                            <ul class="submenu collapse">
                                <li><a class="nav-link" href="javascript:void(0);">item 4 </a></li>
                                <li><a class="nav-link" href="javascript:void(0);">item 5 </a></li>
                                <li><a class="nav-link" href="javascript:void(0);">item 6 </a></li>
                                <li><a class="nav-link" href="javascript:void(0);">item 7 </a></li>
                            </ul>
                        </li>

                        <li class="nav-item has-submenu">
                            <a class="nav-link" href="javascript:void(0);">
                                <i class="fa-solid fa-envelope"></i>
                                Email setup  <i class="fa-solid fa-chevron-down float-end"></i>
                            </a>
                            <ul class="submenu collapse">
                                <li><a class="nav-link" href="javascript:void(0);">item 4 </a></li>
                                <li><a class="nav-link" href="javascript:void(0);">item 5 </a></li>
                                <li><a class="nav-link" href="javascript:void(0);">item 6 </a></li>
                                <li><a class="nav-link" href="javascript:void(0);">item 7 </a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="position-sticky bg-footer bottom-0 d-flex align-items-center justify-content-between border-top">
                <div class="dropup">
                    <div class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="img-fluid brand-sm-logo" src="{{ optional(auth()->guard('web'))->user()->avatar }}" alt="profile picture">
                        {{ optional(auth()->guard('web'))->user()->name }}
                        <ul class="dropdown-menu text-center">
                            <li>
                                <a href="">Settings</a>
                            </li>
                            <li>
                                <a href="">Profile</a>
                            </li>
                            <li>
                               <a href="{{ route('logout') }}"onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">Logout</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="wrapper">
            <!-- page directory start-->
            <div class="d-flex align-items-center justify-content-between py-2 px-2 border-bottom">
                <button class="btn btn-light btn-hambar" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                    <i class="fa-regular fa-circle-left"></i>
                </button>
                <div class="page-directory">
                    <a href="javascript:void(0);">Dashboard</a> <span class="small">&nbsp; > &nbsp;</span> home
                </div>
            </div>
            
            <!-- page directory end -->
            <main class="main">

                <!-- Cards srart -->
                <div class="row py-2">
                    <div class="col-xl-3 col-md-6">
                        <div class="card total-appointment">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate mb-2 text-white">Total Appointment</p>
                                        <h4 class="mb-2 text-white">1452</h4>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title rounded-3">
                                            <i class="fa-regular fa-calendar-check icon"></i>
                                        </span>
                                    </div>
                                </div>                                            
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card today-appointment">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate mb-2 text-white">Today Appointment</p>
                                        <h4 class="mb-2 text-white">938</h4>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title rounded-3">
                                            <i class="fa-regular fa-calendar-check icon"></i>
                                        </span>
                                    </div>
                                </div>                                              
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card departments">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate mb-2 text-white">Departments</p>
                                        <h4 class="mb-2 text-white">8246</h4>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title rounded-3">
                                            <i class="fa-solid fa-graduation-cap icon"></i>
                                        </span>
                                    </div>
                                </div>                                              
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card doctors">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate mb-2 text-white">Doctors</p>
                                        <h4 class="mb-2 text-white">29670</h4>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title rounded-3">
                                            <i class="fa-solid fa-user-doctor icon"></i>
                                        </span>
                                    </div>
                                </div>                                              
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div>
                <!-- Cards end -->

                <!-- your content goes here -->

            </main>
            <footer>
                <p class="copyright-text position-fixed bottom-0 p-2 mb-0 float-end border-top">&copy; Made with 💖 by <a href="#">Devscodebd</a>. All rights reserved</p>
            </footer>
        </div>

    </section>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>