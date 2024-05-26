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
                              <li><a class="nav-link" href="{{ route('department.create') }}">Add </a></li>
                              <li><a class="nav-link" href="{{ route('department.manage') }}">Manage </a></li>
                          </ul>
                      </li>
                      <li class="nav-item has-submenu">
                          <a class="nav-link" href="javascript:void(0);">
                              <i class="fa-solid fa-user-doctor"></i>
                               Doctor  <i class="fa-solid fa-chevron-down float-end"></i>
                          </a>
                          <ul class="submenu collapse">
                              <li><a class="nav-link" href="{{ route('doctor.create') }}">Add</a></li>
                              <li><a class="nav-link" href="{{ route('doctor.manage') }}">Manage </a></li>
                          </ul>
                      </li>
                      <li class="nav-item has-submenu">
                        <a class="nav-link" href="javascript:void(0);">
                            <i class="fa-solid fa-user-nurse"></i>
                             Nurse  <i class="fa-solid fa-chevron-down float-end"></i>
                        </a>
                        <ul class="submenu collapse">
                            <li><a class="nav-link" href="{{ route('nurse.create') }}">Add</a></li>
                            <li><a class="nav-link" href="{{ route('nurse.manage') }}">Manage </a></li>
                        </ul>
                    </li>
                    <li class="nav-item has-submenu">
                        <a class="nav-link" href="javascript:void(0);">
                            <i class="fa-solid fa-user-tie"></i>
                            Receptionist  <i class="fa-solid fa-chevron-down float-end"></i>
                        </a>
                        <ul class="submenu collapse">
                            <li><a class="nav-link" href="{{ route('reception.create') }}">Add</a></li>
                            <li><a class="nav-link" href="{{ route('reception.manage') }}">Manage </a></li>
                        </ul>
                    </li>
                    <li class="nav-item has-submenu">
                        <a class="nav-link" href="javascript:void(0);">
                            <i class="fa-solid fa-file-invoice-dollar"></i>
                             Accounts  <i class="fa-solid fa-chevron-down float-end"></i>
                        </a>
                        <ul class="submenu collapse">
                            <li><a class="nav-link" href="{{ route('accounts.create') }}">Add </a></li>
                            <li><a class="nav-link" href="{{ route('accounts.manage') }}">Manage </a></li>
                        </ul>
                    </li>
                      <li class="nav-item has-submenu">
                          <a class="nav-link" href="javascript:void(0);">
                              <i class="fa-solid fa-hospital-user"></i>
                               Patient  <i class="fa-solid fa-chevron-down float-end"></i>
                          </a>
                          <ul class="submenu collapse">
                              <li><a class="nav-link" href="{{ route('patient.create') }}">Add </a></li>
                              <li><a class="nav-link" href="{{ route('patient.manage') }}">Manage </a></li>
                          </ul>
                      </li>
                      <li class="nav-item has-submenu">
                          <a class="nav-link" href="javascript:void(0);">
                              <i class="fa-solid fa-calendar-check"></i>
                              Appointment  <i class="fa-solid fa-chevron-down float-end"></i>
                          </a>
                          <ul class="submenu collapse">
                              <li><a class="nav-link" href="javascript:void(0);">All Appointment </a></li>
                              <li><a class="nav-link" href="javascript:void(0);">Daily Appointment </a></li>
                          </ul>
                      </li>
                      
                      <li class="nav-item has-submenu">
                          <a class="nav-link" href="javascript:void(0);">
                              <i class="fa-solid fa-prescription"></i>
                              Prescription  <i class="fa-solid fa-chevron-down float-end"></i>
                          </a>
                          <ul class="submenu collapse">
                              <li><a class="nav-link" href="javascript:void(0);">All Prescription </a></li>
                              <li><a class="nav-link" href="javascript:void(0);">Daily Prescription </a></li>
                          </ul>
                      </li>

                      <li class="nav-item has-submenu">
                          <a class="nav-link" href="javascript:void(0);">
                              <i class="fa-solid fa-comment-sms"></i>
                              Messaging  <i class="fa-solid fa-chevron-down float-end"></i>
                          </a>
                          <ul class="submenu collapse">
                              <li><a class="nav-link" href="{{ route('doctor.list') }}">Doctors </a></li>
                              <li><a class="nav-link" href="{{ route('accounts.list') }}">Accounts </a></li>
                              <li><a class="nav-link" href="{{ route('reception.list') }}">Receptionist </a></li>
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
                      <img class="img-fluid brand-sm-logo" src="{{ optional(auth()->guard('web'))->user()->avatar ?? '' }}" alt="profile picture">
                      {{ optional(auth()->guard('web'))->user()->name ?? '' }}
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