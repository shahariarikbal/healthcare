@extends('admin.master')

@section('content')
    <div class="container mt-3">
          <div class="col-md-12">
               <div class="card">
                    <div class="card-header">
                          Email compose for patient
                    </div>
                    <div class="card-body">
                         <form class="row g-3" action="{{ route('email.send') }}" method="POST">
                              @csrf
                              <div class="col-12">
                                   <label for="department" class="form-label">To <span class="text-danger">*</span></label>
                                   <select class="form-control" name="email_to[]" multiple="multiple" id="email_to">
                                        <option disabled>Select Email</option>
                                        @foreach ($chunks as $chunk)
                                             @foreach ($chunk as $email)
                                                <option value="{{ $email->email }}">{{ Str::ucfirst($email->email ?? '') }}</option>
                                             @endforeach
                                        @endforeach
                                   </select>
                                   <span class="text-danger">{{ $errors->has('email_to') ? $errors->first('email_to') : ' ' }}</span>
                              </div>
                              <div class="col-md-12">
                                   <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control" name="subject" value="{{ old('subject') }}" placeholder="Email subject..."/>
                                   <span class="text-danger">{{ $errors->has('subject') ? $errors->first('subject') : ' ' }}</span>
                              </div>
                              
                              <div class="col-md-12">
                                   <label for="body" class="form-label">Body <span class="text-danger">*</span></label>
                                   <textarea class="form-control" name="body" rows="8" placeholder="Enter email content...">{{ old('body') }}</textarea>
                                   <span class="text-danger">{{ $errors->has('body') ? $errors->first('body') : ' ' }}</span>
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