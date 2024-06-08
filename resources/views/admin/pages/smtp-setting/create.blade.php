@extends('admin.master')

@section('content')
    <div class="container mt-3">
          <div class="col-lg-12 col-md-12 mb-25">
               <div class="card">
                    <div class="card-header">
                         Update SMTP
                    </div>
                    <div class="card-body">
                         <form class="row g-3" action="{{ route('smtp.setting.store') }}" method="POST">
                              @csrf
                              <div class="col-lg-4 col-md-4 col-sm-12">
                                   <label for="mail_mailer" class="form-label">Mailer <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control" name="mail_mailer" value="{{ $setting->mail_mailer ?? old('mail_mailer') }}" placeholder="eg: smtp"/>
                                   <span class="text-danger">{{ $errors->has('mail_mailer') ? $errors->first('mail_mailer') : ' ' }}</span>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-12">
                                   <label for="mail_host" class="form-label">Host <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control" name="mail_host" value="{{ $setting->mail_host ?? old('mail_host') }}" placeholder="eg: mail host"/>
                                   <span class="text-danger">{{ $errors->has('mail_host') ? $errors->first('mail_host') : ' ' }}</span>
                              </div>

                              <div class="col-lg-4 col-md-4 col-sm-12">
                                   <label for="mail_port" class="form-label">Port <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control" name="mail_port" value="{{ $setting->mail_port ?? old('mail_port') }}" placeholder="eg: 2525"/>
                                   <span class="text-danger">{{ $errors->has('mail_port') ? $errors->first('mail_port') : ' ' }}</span>
                              </div>

                              <div class="col-lg-4 col-md-4 col-sm-12">
                                   <label for="mail_username" class="form-label">Username <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control" name="mail_username" value="{{ $setting->mail_username ?? old('mail_username') }}" placeholder="eg: mail username"/>
                                   <span class="text-danger">{{ $errors->has('mail_username') ? $errors->first('mail_username') : ' ' }}</span>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-12">
                                   <label for="mail_password" class="form-label">Password <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control" name="mail_password" value="{{ $setting->mail_password ?? old('mail_password') }}" placeholder="eg: *****"/>
                                   <span class="text-danger">{{ $errors->has('mail_password') ? $errors->first('mail_password') : ' ' }}</span>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-12">
                                   <label for="mail_encryption" class="form-label">Encryption </label>
                                   <input type="text" class="form-control" name="mail_encryption" value="{{ $setting->mail_encryption ?? old('mail_encryption') }}" placeholder="eg: tls/ssl"/>
                              </div>

                              <div class="col-lg-6 col-md-6 col-sm-12">
                                   <label for="mail_from_address" class="form-label">From Address <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control" name="mail_from_address" value="{{ $setting->mail_from_address ?? old('mail_from_address') }}" placeholder="eg: from address"/>
                                   <span class="text-danger">{{ $errors->has('mail_from_address') ? $errors->first('mail_from_address') : ' ' }}</span>
                              </div>

                              <div class="col-lg-6 col-md-6 col-sm-12">
                                   <label for="mail_from_name" class="form-label">From Name <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control" name="mail_from_name" value="{{ $setting->mail_from_name ?? old('mail_from_name') }}" placeholder="eg: from name"/>
                                   <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : ' ' }}</span>
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