<div class="offcanvas offcanvas-start show" data-bs-scroll="false" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
    <div class="offcanvas-header justify-content-center">
        <a href="{{ route('admin.dashboard') }}">
            <img src="{{ asset(App\Constants\Statics::DEFAULT_LOGO_SET) }}" />
        </a>
    </div>
    <div class="offcanvas-body">
        <nav class="sidebar">
            <ul class="nav-list" id="nav_accordion">
                <li class="nav-list-item {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                  <a class="nav-list-item-link" href="{{ route('admin.dashboard') }}">
                      <i class="fa-solid fa-house-chimney"></i>
                      Home
                  </a>
                </li>
                <li class="nav-list-item has-submenu {{ Route::is('department*') ? 'active' : '' }}">
                    <a class="nav-list-item-link" href="javascript:void(0);"> 
                        <i class="fa-solid fa-graduation-cap"></i>
                        Department 
                        <i class="fa-solid fa-chevron-down float-end"></i>
                    </a>
                    <ul class="submenu-list collapse {{ Route::is('department*') ? 'show' : '' }}">
                        <li class="submenu-list-item {{ Route::is('department.create') ? 'active' : '' }}">
                            <a class="submenu-list-item-link" href="{{ route('department.create') }}">Add</a>
                        </li>
                        <li class="submenu-list-item {{ Route::is('department.manage') ? 'active' : '' }}">
                            <a class="submenu-list-item-link" href="{{ route('department.manage') }}">Manage</a>
                        </li>
                    </ul>
                </li>
                
                <li class="nav-list-item has-submenu {{ Route::is('doctor*') ? 'active' : '' }}">
                      <a class="nav-list-item-link" href="javascript:void(0);">
                          <i class="fa-solid fa-user-doctor"></i>
                           Doctor  <i class="fa-solid fa-chevron-down float-end"></i>
                      </a>
                      <ul class="submenu-list collapse {{ Route::is('doctor*') ? 'show' : '' }}">
                            <li class="submenu-list-item">
                                <a class="submenu-list-item-link" href="{{ route('doctor.create') }}">Add</a>
                            </li>
                            <li class="submenu-list-item">
                                <a class="submenu-list-item-link" href="{{ route('doctor.manage') }}">Manage </a>
                            </li>
                      </ul>
                </li>
                <li class="nav-list-item has-submenu {{ Route::is('nurse*') ? 'active' : '' }}">
                    <a class="nav-list-item-link" href="javascript:void(0);">
                        <i class="fa-solid fa-user-nurse"></i>
                         Nurse  <i class="fa-solid fa-chevron-down float-end"></i>
                    </a>
                    <ul class="submenu-list collapse {{ Route::is('nurse*') ? 'show' : '' }}">
                        <li class="submenu-list-item">
                            <a class="submenu-list-item-link" href="{{ route('nurse.create') }}">Add</a>
                        </li>
                        <li class="submenu-list-item">
                            <a class="submenu-list-item-link" href="{{ route('nurse.manage') }}">Manage </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-list-item has-submenu {{ Route::is('reception*') ? 'active' : '' }}">
                    <a class="nav-list-item-link" href="javascript:void(0);">
                        <i class="fa-solid fa-user-tie"></i>
                        Receptionist  <i class="fa-solid fa-chevron-down float-end"></i>
                    </a>
                    <ul class="submenu-list collapse {{ Route::is('reception*') ? 'show' : '' }}">
                        <li class="submenu-list-item">
                            <a class="submenu-list-item-link" href="{{ route('reception.create') }}">Add</a>
                        </li>
                        <li class="submenu-list-item">
                            <a class="submenu-list-item-link" href="{{ route('reception.manage') }}">Manage </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-list-item has-submenu {{ Route::is('accounts*') ? 'active open' : '' }}">
                    <a class="nav-list-item-link" href="javascript:void(0);">
                        <i class="fa-solid fa-file-invoice-dollar"></i>
                         Accounts  <i class="fa-solid fa-chevron-down float-end"></i>
                    </a>
                    <ul class="submenu-list collapse {{ Route::is('accounts*') ? 'show' : '' }}">
                        <li class="submenu-list-item">
                            <a class="submenu-list-item-link" href="{{ route('accounts.create') }}">Add </a>
                        </li>
                        <li class="submenu-list-item">
                            <a class="submenu-list-item-link" href="{{ route('accounts.manage') }}">Manage </a>
                        </li>
                        <li class="submenu-list-item">
                            <a class="submenu-list-item-link" href="{{ route('accounts.expanse.manage') }}">Expanse </a>
                        </li>
                        
                        <li class="submenu-list-item">
                            <a class="submenu-list-item-link" href="{{ route('accounts.billing.manage') }}">Billings </a>
                        </li>
                        <li class="submenu-list-item">
                            <a class="submenu-list-item-link" href="{{ route('accounts.billing.invoice') }}">Invoices </a>
                        </li>
                        <li class="submenu-list-item">
                            <a class="submenu-list-item-link" href="{{ route('accounts.manage') }}">Report </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-list-item has-submenu {{ Route::is('patient*') ? 'active' : '' }}">
                    <a class="nav-list-item-link" href="javascript:void(0);">
                        <i class="fa-solid fa-hospital-user"></i>
                        Patient
                        <i class="fa-solid fa-chevron-down float-end"></i>
                    </a>
                    <ul class="submenu-list collapse {{ Route::is('patient*') ? 'show' : '' }}">
                        <li class="submenu-list-item">
                            <a class="submenu-list-item-link" href="{{ route('patient.create') }}">Add </a>
                        </li>
                        <li class="submenu-list-item">
                            <a class="submenu-list-item-link" href="{{ route('patient.manage') }}">Manage </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-list-item has-submenu {{ Route::is('appointment*') ? 'active' : '' }}">
                    <a class="nav-list-item-link" href="javascript:void(0);">
                        <i class="fa-solid fa-calendar-check"></i>
                        Appointment  <i class="fa-solid fa-chevron-down float-end"></i>
                    </a>
                    <ul class="submenu-list collapse {{ Route::is('appointment*') ? 'show' : '' }}">
                        <li class="submenu-list-item">
                            <a class="submenu-list-item-link" href="{{ route('appointment.all') }}">All Appointment </a>
                        </li>
                        <li class="submenu-list-item">
                            <a class="submenu-list-item-link" href="{{ route('appointment.daily') }}">Today Appointment </a>
                        </li>
                    </ul>
                </li>              
                <li class="nav-list-item has-submenu">
                    <a class="nav-list-item-link" href="javascript:void(0);">
                        <i class="fa-solid fa-prescription"></i>
                          Prescription  <i class="fa-solid fa-chevron-down float-end"></i>
                    </a>
                    <ul class="submenu-list collapse">
                        <li class="submenu-list-item">
                            <a class="submenu-list-item-link" href="{{ route('all.prescriptions') }}">All Prescription </a>
                        </li>
                        <li class="submenu-list-item">
                            <a class="submenu-list-item-link" href="{{ route('daily.prescriptions') }}">Daily Prescription </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-list-item has-submenu">
                    <a class="nav-list-item-link" href="javascript:void(0);">
                        <i class="fa-solid fa-comment-sms"></i>
                        Messaging  <i class="fa-solid fa-chevron-down float-end"></i>
                    </a>
                    <ul class="submenu-list collapse">
                        <li class="submenu-list-item">
                            <a class="submenu-list-item-link" href="{{ route('doctor.list') }}">Doctors </a>
                        </li>
                        <li class="submenu-list-item">
                            <a class="submenu-list-item-link" href="{{ route('accounts.list') }}">Accounts </a>
                        </li>
                        <li class="submenu-list-item">
                            <a class="submenu-list-item-link" href="{{ route('reception.list') }}">Receptionist </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-list-item has-submenu">
                    <a class="nav-list-item-link" href="javascript:void(0);">
                        <i class="fa-solid fa-envelope"></i>
                        Send E-mail  <i class="fa-solid fa-chevron-down float-end"></i>
                    </a>
                    <ul class="submenu-list collapse">
                        <li class="submenu-list-item">
                            <a class="submenu-list-item-link" href="{{ route('email.create') }}">Email Compose </a>
                        </li>
                        <li class="submenu-list-item">
                            <a class="submenu-list-item-link" href="{{ route('email.manage') }}">All Email </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-list-item has-submenu">
                    <a class="nav-list-item-link" href="javascript:void(0);">
                        <i class="fa-solid fa-envelope"></i>
                        SMTP Config  <i class="fa-solid fa-chevron-down float-end"></i>
                    </a>
                    <ul class="submenu-list collapse">
                        <li class="submenu-list-item">
                            <a class="submenu-list-item-link" href="{{ route('smtp.setting') }}">SMTP Settings </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>