@extends('admin.master')

@section('content')
    <div class="container mt-3">
          <div class="col-lg-12 col-md-12">
               <div class="card">
                    <div class="card-header hc-header-outer">
                         <h4 class="hc-header-title">
                            Expanse update
                         </h4>
                         <a href="{{ route('accounts.expanse.manage') }}" class="btn btn-sm btn-manage">Manage</a>
                    </div>
                    <div class="card-body">
                         <form class="row g-3" action="{{ route('accounts.expanse.update', $expanse->id) }}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <div class="col-lg-4 col-md-4 col-sm-12">
                                   <label for="expanse_date" class="form-label">Expanse date <span class="text-danger">*</span></label>
                                   <input type="date" class="form-control" name="expanse_date" value="{{ $expanse->expanse_date ?? old('expanse_date') }}" placeholder="Enter Expanse date..."/>
                                   <span class="text-danger">{{ $errors->has('expanse_date') ? $errors->first('expanse_date') : ' ' }}</span>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-12">
                                   <label for="amount" class="form-label">Amount <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control" name="amount" value="{{ $expanse->amount ?? old('amount') }}" placeholder="Enter amount.."/>
                                   <span class="text-danger">{{ $errors->has('amount') ? $errors->first('amount') : ' ' }}</span>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-12">
                                   <label for="image" class="form-label">Image <span class="text-danger"></span></label>
                                   <input type="file" class="form-control" name="image" value="{{ old('image') }}"/>
                                   @if(!empty($expanse->image))
                                   <img src="{{ asset($expanse->image) }}" id="imagePreview" class="receipt-img" />
                                   @else
                                   <img src="{{ asset(App\Constants\Statics::DEFAULT_RECEIPT_SET) }}" class="receipt-img mt-1" />
                                   @endif
                                   <span class="text-danger">{{ $errors->has('image') ? $errors->first('image') : ' ' }}</span>
                              </div>
                              <div class="col-lg-12 col-md-12 col-sm-12">
                                   <label for="purpose" class="form-label">Purpose <span class="text-danger">*</span></label>
                                   <textarea class="form-control" name="purpose" rows="5" placeholder="Enter purpose">{{ $expanse->purpose ?? old('purpose') }}</textarea>
                                   <span class="text-danger">{{ $errors->has('purpose') ? $errors->first('purpose') : ' ' }}</span>
                              </div>

                              <div class="col-12">
                                   <button type="submit" class="btn btn-submit">Submit</button>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
    </div>
@endsection