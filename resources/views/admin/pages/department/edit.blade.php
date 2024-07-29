@extends('admin.master')

@section('content')
    <div class="container mt-3">
          <div class="col-md-12">
               <div class="card">
                    <div class="card-header hc-header-outer">
                         <h4 class="hc-header-title">
                            Department edit
                         </h4>                          
                         <a href="{{ route('department.manage') }}" class="btn btn-sm btn-manage">Manage</a>
                    </div>
                    <div class="card-body">
                         <form action="{{ route('department.update', $department->id) }}" method="post">
                              @csrf
                              <div class="input-group mb-3">
                                   <input type="text" class="form-control" name="name" value="{{ $department->name ?? old('name') }}" placeholder="Enter departname name..."/>
                              </div>
                              <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : ' ' }}</span>
                              
                              <button type="submit" class="btn btn-submit">Update</button>
                         </form>
                    </div>
               </div>
          </div>
    </div>
@endsection

@push('script')
    
@endpush