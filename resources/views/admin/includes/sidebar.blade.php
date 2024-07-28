<div class="offcanvas offcanvas-start show" data-bs-scroll="false" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
    <div class="offcanvas-header justify-content-center">
        @foreach ($guards as $guard => $data)
            @if (auth()->guard($guard)->check())
                <a href="{{ route($data['home-route']) }}">
                    <img src="{{ asset(App\Constants\Statics::DEFAULT_LOGO_SET) }}" />
                </a>
            @endif
        @endforeach
    </div>
    <div class="offcanvas-body">
        <nav class="sidebar">
            <ul class="nav-list" id="nav_accordion">
                @foreach ($guards as $guard => $data)
                    @if (auth()->guard($guard)->check())
                        <li class="nav-list-item {{ Route::currentRouteName() === $data['home-route'] ? 'active' : '' }}">
                            <a class="nav-list-item-link" href="{{ route($data['home-route']) }}">
                                <i class="fa-solid fa-house-chimney"></i>
                                Dashboard
                            </a>
                        </li>
                    @endif
                @endforeach
                
                @if(auth()->guard('web')->check() || auth()->guard('receptionist')->check() || auth()->guard('account')->check() || auth()->guard('doctor')->check())
                    <li class="nav-list-item has-submenu {{ Route::is('department*') ? 'active' : '' }}">
                        <a class="nav-list-item-link" href="javascript:void(0);"> 
                            <i class="fa-solid fa-graduation-cap"></i>
                            Department 
                            <i class="fa-solid fa-chevron-down float-end"></i>
                        </a>
                        <ul class="submenu-list collapse {{ Route::is('department*') ? 'show' : '' }}">
                            @if(auth()->guard('web')->check())
                                <li class="submenu-list-item {{ Route::is('department.create') ? 'active' : '' }}">
                                    <a class="submenu-list-item-link" href="{{ route('department.create') }}">Add</a>
                                </li>
                            @endif
                            @if(auth()->guard('web')->check() || auth()->guard('receptionist')->check() || auth()->guard('account')->check() || auth()->guard('doctor')->check())
                                <li class="submenu-list-item {{ Route::is('department.manage') ? 'active' : '' }}">
                                    <a class="submenu-list-item-link" href="{{ route('department.manage') }}">Manage</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(auth()->guard('web')->check() || auth()->guard('receptionist')->check() || auth()->guard('account')->check())
                    <li class="nav-list-item has-submenu {{ Route::is('doctor*') ? 'active' : '' }}">
                        <a class="nav-list-item-link" href="javascript:void(0);">
                            <i class="fa-solid fa-user-doctor"></i>
                            Doctor  <i class="fa-solid fa-chevron-down float-end"></i>
                        </a>
                        <ul class="submenu-list collapse {{ Route::is('doctor*') ? 'show' : '' }}">
                            @if(auth()->guard('web')->check())
                                <li class="submenu-list-item">
                                    <a class="submenu-list-item-link" href="{{ route('doctor.create') }}">Add</a>
                                </li>
                            @endif
                            @if(auth()->guard('web')->check() || auth()->guard('receptionist')->check() || auth()->guard('account')->check())
                                <li class="submenu-list-item">
                                    <a class="submenu-list-item-link" href="{{ route('doctor.manage') }}">Manage </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(auth()->guard('web')->check() || auth()->guard('receptionist')->check() || auth()->guard('account')->check())
                    <li class="nav-list-item has-submenu {{ Route::is('nurse*') ? 'active' : '' }}">
                        <a class="nav-list-item-link" href="javascript:void(0);">
                            <i class="fa-solid fa-user-nurse"></i>
                            Nurse/Compounder  <i class="fa-solid fa-chevron-down float-end"></i>
                        </a>
                        <ul class="submenu-list collapse {{ Route::is('nurse*') ? 'show' : '' }}">
                            @if(auth()->guard('web')->check())
                                <li class="submenu-list-item">
                                    <a class="submenu-list-item-link" href="{{ route('nurse.create') }}">Add</a>
                                </li>
                            @endif
                            @if(auth()->guard('web')->check() || auth()->guard('receptionist')->check() || auth()->guard('account')->check())
                                <li class="submenu-list-item">
                                    <a class="submenu-list-item-link" href="{{ route('nurse.manage') }}">Manage </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(auth()->guard('web')->check() || auth()->guard('receptionist')->check() || auth()->guard('account')->check())
                    <li class="nav-list-item has-submenu {{ Route::is('reception*') ? 'active' : '' }}">
                        <a class="nav-list-item-link" href="javascript:void(0);">
                            <i class="fa-solid fa-user-tie"></i>
                            Receptionist  <i class="fa-solid fa-chevron-down float-end"></i>
                        </a>
                        <ul class="submenu-list collapse {{ Route::is('reception*') ? 'show' : '' }}">
                            @if(auth()->guard('web')->check())
                                <li class="submenu-list-item">
                                    <a class="submenu-list-item-link" href="{{ route('reception.create') }}">Add</a>
                                </li>
                            @endif
                            @if(auth()->guard('web')->check() || auth()->guard('receptionist')->check() || auth()->guard('account')->check())
                                <li class="submenu-list-item">
                                    <a class="submenu-list-item-link" href="{{ route('reception.manage') }}">Manage </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(auth()->guard('web')->check() || auth()->guard('account')->check() || auth()->guard('receptionist')->check())
                    <li class="nav-list-item has-submenu {{ Route::is('accounts*') ? 'active open' : '' }}">
                        <a class="nav-list-item-link" href="javascript:void(0);">
                            <i class="fa-solid fa-file-invoice-dollar"></i>
                            Accounts  <i class="fa-solid fa-chevron-down float-end"></i>
                        </a>
                        <ul class="submenu-list collapse {{ Route::is('accounts*') ? 'show' : '' }}">
                            @if(auth()->guard('web')->check())
                                <li class="submenu-list-item">
                                    <a class="submenu-list-item-link" href="{{ route('accounts.create') }}">Add Accounts</a>
                                </li>
                                <li class="submenu-list-item">
                                    <a class="submenu-list-item-link" href="{{ route('accounts.manage') }}">Manage Accounts</a>
                                </li>
                            @endif
                            @if(auth()->guard('web')->check() || auth()->guard('receptionist')->check())
                                <li class="submenu-list-item">
                                    <a class="submenu-list-item-link" href="{{ route('accounts.expanse.manage') }}">Manage Expanses </a>
                                </li>
                                
                                <li class="submenu-list-item">
                                    <a class="submenu-list-item-link" href="{{ route('accounts.billing.manage') }}">Pending Bills </a>
                                </li>
                                <li class="submenu-list-item">
                                    <a class="submenu-list-item-link" href="{{ route('accounts.payment.report.manage') }}">Payment Reports </a>
                                </li>
                            @endif
                            @if(auth()->guard('account')->check())
                                <li class="submenu-list-item">
                                    <a class="submenu-list-item-link" href="{{ route('accounts.expanse.manage') }}">Manage Expanses </a>
                                </li>
                                
                                <li class="submenu-list-item">
                                    <a class="submenu-list-item-link" href="{{ route('accounts.billing.manage') }}">Pending Bills </a>
                                </li>
                                <li class="submenu-list-item">
                                    <a class="submenu-list-item-link" href="{{ route('accounts.invoice.manage') }}">Manage Invoices </a>
                                </li>
                                <li class="submenu-list-item">
                                    <a class="submenu-list-item-link" href="{{ route('accounts.payment.report.manage') }}">Payment Reports </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(auth()->guard('web')->check() || auth()->guard('account')->check() || auth()->guard('receptionist')->check())
                    <li class="nav-list-item has-submenu {{ Route::is('patient*') ? 'active' : '' }}">
                        <a class="nav-list-item-link" href="javascript:void(0);">
                            <i class="fa-solid fa-hospital-user"></i>
                            Patient
                            <i class="fa-solid fa-chevron-down float-end"></i>
                        </a>
                        <ul class="submenu-list collapse {{ Route::is('patient*') ? 'show' : '' }}">
                            @if(auth()->guard('web')->check())
                                <li class="submenu-list-item">
                                    <a class="submenu-list-item-link" href="{{ route('patient.create') }}">Add </a>
                                </li>
                            @endif
                            @if(auth()->guard('web')->check() || auth()->guard('account')->check() || auth()->guard('receptionist')->check())
                                <li class="submenu-list-item">
                                    <a class="submenu-list-item-link" href="{{ route('patient.manage') }}">Manage </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(auth()->guard('web')->check() || auth()->guard('account')->check() || auth()->guard('receptionist')->check())
                    <li class="nav-list-item has-submenu {{ Route::is('appointment*') ? 'active' : '' }}">
                        <a class="nav-list-item-link" href="javascript:void(0);">
                            <i class="fa-solid fa-calendar-check"></i>
                            Appointment  <i class="fa-solid fa-chevron-down float-end"></i>
                        </a>
                        <ul class="submenu-list collapse {{ Route::is('appointment*') ? 'show' : '' }}">
                            @if(auth()->guard('web')->check() || auth()->guard('receptionist')->check())
                                <li class="submenu-list-item">
                                    <a class="submenu-list-item-link" href="{{ route('appointment.create') }}">Add Appointment </a>
                                </li>
                            @endif
                            @if(auth()->guard('web')->check() || auth()->guard('account')->check() || auth()->guard('receptionist')->check())
                                <li class="submenu-list-item">
                                    <a class="submenu-list-item-link" href="{{ route('appointment.all') }}">All Appointments </a>
                                </li>
                                <li class="submenu-list-item">
                                    <a class="submenu-list-item-link" href="{{ route('appointment.schedule') }}">Schedule Appointments </a>
                                </li>
                                <li class="submenu-list-item">
                                    <a class="submenu-list-item-link" href="{{ route('appointment.daily') }}">Today Appointments </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(auth()->guard('web')->check() || auth()->guard('doctor')->check())              
                    <li class="nav-list-item has-submenu {{ Route::is('prescription*') ? 'active' : '' }}">
                        <a class="nav-list-item-link" href="javascript:void(0);">
                            <i class="fa-solid fa-prescription"></i>
                            Prescription  <i class="fa-solid fa-chevron-down float-end"></i>
                        </a>
                        <ul class="submenu-list collapse {{ Route::is('prescription*') ? 'show' : '' }}">
                            @if(auth()->guard('doctor')->check())
                                <li class="submenu-list-item">
                                    <a class="submenu-list-item-link" href="{{ route('prescription.add') }}">Add Prescription </a>
                                </li>
                                <li class="submenu-list-item">
                                    <a class="submenu-list-item-link" href="{{ route('auth.doctor.prescription.list') }}">All Prescription </a>
                                </li>
                                <li class="submenu-list-item">
                                    <a class="submenu-list-item-link" href="{{ route('prescription.today') }}">Today Prescription </a>
                                </li>
                            @endif
                            @if(auth()->guard('web')->check())
                                <li class="submenu-list-item">
                                    <a class="submenu-list-item-link" href="{{ route('prescription.all') }}">All Prescription </a>
                                </li>
                                <li class="submenu-list-item">
                                    <a class="submenu-list-item-link" href="{{ route('prescription.daily') }}">Daily Prescription </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(auth()->guard('web')->check())
                    <li class="nav-list-item has-submenu {{ Route::is('message*') ? 'active' : '' }}">
                        <a class="nav-list-item-link" href="javascript:void(0);">
                            <i class="fa-solid fa-comment-sms"></i>
                            Messaging  <i class="fa-solid fa-chevron-down float-end"></i>
                        </a>
                        <ul class="submenu-list collapse {{ Route::is('message*') ? 'show' : '' }}">
                            <li class="submenu-list-item">
                                <a class="submenu-list-item-link" href="{{ route('message.doctors.index') }}">Doctors </a>
                            </li>
                            <li class="submenu-list-item">
                                <a class="submenu-list-item-link" href="{{ route('message.accounts.index') }}">Accounts </a>
                            </li>
                            <li class="submenu-list-item">
                                <a class="submenu-list-item-link" href="{{ route('message.receptionist.index') }}">Receptionist </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(auth()->guard('web')->check() || auth()->guard('receptionist')->check())
                    <li class="nav-list-item has-submenu {{ Route::is('email*') ? 'active' : '' }}">
                        <a class="nav-list-item-link" href="javascript:void(0);">
                            <i class="fa-solid fa-envelope"></i>
                            Send E-mail  <i class="fa-solid fa-chevron-down float-end"></i>
                        </a>
                        <ul class="submenu-list collapse {{ Route::is('email*') ? 'show' : '' }}">
                            <li class="submenu-list-item">
                                <a class="submenu-list-item-link" href="{{ route('email.create') }}">Email Compose </a>
                            </li>
                            <li class="submenu-list-item">
                                <a class="submenu-list-item-link" href="{{ route('email.manage') }}">All Email </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(auth()->guard('web')->check())
                    <li class="nav-list-item has-submenu {{ Route::is('smtp*') ? 'active' : '' }}">
                        <a class="nav-list-item-link" href="javascript:void(0);">
                            <i class="fa-solid fa-envelope"></i>
                            SMTP Config  <i class="fa-solid fa-chevron-down float-end"></i>
                        </a>
                        <ul class="submenu-list collapse {{ Route::is('smtp*') ? 'show' : '' }}">
                            <li class="submenu-list-item">
                                <a class="submenu-list-item-link" href="{{ route('smtp.setting') }}">SMTP Settings </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @foreach ($guards as $guard => $data)
                    @if(auth()->guard($guard)->check())
                        <li class="nav-list-item has-submenu {{ in_array(Route::currentRouteName(), $data['routes']) ? 'active' : '' }}">
                            <a class="nav-list-item-link" href="javascript:void(0);">
                                <i class="{{ $data['icon'] }}"></i>
                                {{ $data['label'] }}  <i class="fa-solid fa-chevron-down float-end"></i>
                            </a>
                            <ul class="submenu-list collapse {{ in_array(Route::currentRouteName(), $data['routes']) ? 'show' : '' }}">
                                @foreach ($data['submenu'] as $submenu)
                                    <li class="submenu-list-item">
                                        <a class="submenu-list-item-link" href="{{ route($submenu['route']) }}">{{ $submenu['label'] }} </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>
    </div>
</div>