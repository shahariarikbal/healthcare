<div class="d-flex align-items-center justify-content-between py-1 px-2 border-bottom bg-header">
    <button class="sidebar-toggle-btn" type="button" id="sidebarToggle">
        <i class="fas fa-th-large"></i>
    </button>
    <div class="d-flex align-items-center">   
        <div class="page-directory">
            <a href="{{ url('clear') }}" class="text-white btn btn-add">Cache Clear</a>
        </div>
        @foreach ($guards as $guard => $data)
            @if (auth()->guard($guard)->check())
                <div class="dropdown-toggle custom-profile-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="custom-profile-dropdown-image" src="{{ optional(auth()->guard($guard))->user()->avatar ?? '' }}" alt="avater">
                    <span class="custom-profile-dropdown-name">
                        {{ optional(auth()->guard($guard))->user()->full_name ?? 'Admin' }}
                    </span>
                    <ul class="dropdown-menu custom-profile-dropdown-menu">
                        <li>
                        <a href="{{ route($data['logout-route']) }}"onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Logout</a>
    
                            <form id="logout-form" action="{{ route($data['logout-route']) }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            @endif
        @endforeach
     </div>
</div>