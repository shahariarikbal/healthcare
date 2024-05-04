<div class="d-flex align-items-center justify-content-between py-2 px-2 border-bottom bg-header">
    <button class="btn btn-light btn-hambar" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
        <i class="fa-regular fa-circle-left"></i>
    </button>
    <div class="page-directory">
        <a href="{{ route('admin.dashboard') }}" class="text-white">Dashboard</a> <span class="small">&nbsp; > &nbsp;</span> {{ optional(auth()->guard('web'))->user()->name ?? '' }}
    </div>
</div>