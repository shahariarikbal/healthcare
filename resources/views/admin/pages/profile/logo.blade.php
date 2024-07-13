@extends('admin.master')

@section('content')
    <div class="container-fluid mt-3">
          <div class="col-lg-12 col-md-12 mb-25">
               <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                         <div class="card">
                              <div class="card-header">
                                   Logo settings
                              </div>
                              <div class="card-body">
                                   <form class="row g-3" action="{{ route('admin.logo.update') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                             <label for="logo" class="form-label">Logo <span class="text-danger">*</span></label>
                                             <input type="file" class="form-control" name="logo" onchange="imageChange(event)" />
                                             @if(isset($authUser->logo))
                                             <img src="{{ asset($authUser->logo) }}" id="imagePreview" class="logo-size"/>
                                             @else
                                             <img src="{{ asset(App\Constants\Statics::DEFAULT_LOGO_SET) }}" class="logo-size"  />
                                             @endif
                                             <span class="text-danger">{{ $errors->has('logo') ? $errors->first('logo') : ' ' }}</span>
                                        </div>
                                        <div class="col-12">
                                             <button type="submit" class="btn btn-submit">Submit</button>
                                        </div>
                                   </form>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
    </div>
</div>
@endsection