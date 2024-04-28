<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <section class="main-wrapper">
        <div class="offcanvas offcanvas-start show" data-bs-scroll="false" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
            <div class="offcanvas-header justify-content-center">
                <a href="javascript:void(0);"><img class="brand-sm-logo" src="./assets/images/logo.webp" alt="brand logo"></a>
                <p class="brand-name">Google</p>
            </div>
            <div class="offcanvas-body">
                <nav class="sidebar">
                    <ul class="nav flex-column" id="nav_accordion">
                        <p class="menu-title">Dashboard</p>
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">Dashboard home</a>
                        </li>
                        <li class="nav-item has-submenu">
                            <a class="nav-link" href="javascript:void(0);"> Submenus  <i class="bi bi-chevron-down float-end"></i></a>
                            <ul class="submenu collapse">
                                <li><a class="nav-link" href="javascript:void(0);">item 1 </a></li>
                                <li><a class="nav-link" href="javascript:void(0);">item 2 </a></li>
                                <li><a class="nav-link" href="javascript:void(0);">item 3 </a> </li>
                            </ul>
                        </li>
                        <li class="nav-item has-submenu">
                            <a class="nav-link" href="javascript:void(0);"> More submenus  <i class="bi bi-chevron-down float-end"></i></a>
                            <ul class="submenu collapse">
                                <li><a class="nav-link" href="javascript:void(0);">item 4 </a></li>
                                <li><a class="nav-link" href="javascript:void(0);">item 5 </a></li>
                                <li><a class="nav-link" href="javascript:void(0);">item 6 </a></li>
                                <li><a class="nav-link" href="javascript:void(0);">item 7 </a></li>
                            </ul>
                        </li>
                        <p class="menu-title">Others</p>
                        <li class="nav-item">
                            <a class="nav-link" href="./pages/tables.html"> Tables </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./index.html"> Cards </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="position-sticky bg-dark-subtle bottom-0 d-flex align-items-center justify-content-between border-top">
                <div class="dropup">
                    <div class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="img-fluid brand-sm-logo" src="./assets/images/logo.webp" alt="profile picture">
                        Jhone Doe
                        <ul class="dropdown-menu text-center">
                            <li>Settings</li>
                            <li>Profile</li>
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
                <!-- <form action="" method="post">
                    <i class="bi bi-box-arrow-in-right icon" title="logout"></i>
                </form> -->
            </div>
        </div>

        <div class="wrapper">
            <!-- page directory start-->
            <div class="d-flex align-items-center justify-content-between py-2 px-2 border-bottom">
                <button class="btn btn-light btn-hambar" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                    <i class="bi bi-list"></i>
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
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate mb-2">Total Sales</p>
                                        <h4 class="mb-2">1452</h4>
                                        <p class="text-muted mb-0 small"><span class="text-success fw-bold me-2">9.23%</span>from previous period</p>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light rounded-3">
                                            <i class="bi bi-cart-check text-primary icon"></i>
                                        </span>
                                    </div>
                                </div>                                            
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate mb-2">New Orders</p>
                                        <h4 class="mb-2">938</h4>
                                        <p class="text-muted mb-0 small"><span class="text-danger fw-bold me-2">1.09%</span>from previous period</p>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light rounded-3">
                                            <i class="bi bi-cash icon text-success "></i>
                                        </span>
                                    </div>
                                </div>                                              
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate mb-2">New Users</p>
                                        <h4 class="mb-2">8246</h4>
                                        <p class="text-muted mb-0 small"><span class="text-success fw-bold me-2">16.2%</span>from previous period</p>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light rounded-3">
                                            <i class="fa-solid fa-user"></i>
                                            <i class="bi bi-person icon text-success "></i>
                                        </span>
                                    </div>
                                </div>                                              
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate mb-2">Unique Visitors</p>
                                        <h4 class="mb-2">29670</h4>
                                        <p class="text-muted mb-0 small"><span class="text-success fw-bold me-2">11.7%</span>from previous period</p>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light rounded-3">
                                            <i class="bi bi-person text-success icon"></i>
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