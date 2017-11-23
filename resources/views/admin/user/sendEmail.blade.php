@extends('layouts.admin.admin')
@section('content')
  <div class="block-header">
      <h2>@lang('title.sendEmail')</h2>
  </div>

  <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
              <div class="body">
                  <form method="post" action="{{ route('user email') }}" class="form_validation" enctype="multipart/form-data"  novalidate>
                      {!! csrf_field() !!}
                      <input type="hidden" name="email" value="{{$user->email}}" />
                      name
                      <div class="form-group">
                          <div class="form-line">
                              <input id="name" name="name" class="form-control" type="text" value="{{$user->name}}" readonly>
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="form-line">
                              <input id="email" name="email" class="form-control" type="text" value="{{$user->email}}" readonly>
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="form-line {{ $errors->has('message') ? 'error focused' : '' }}">
                              <textarea rows="3" class="form-control no-resize" name="message"></textarea>
                          </div>
                          <div class="help-info">Message to User</div>
                      </div>
                      <button type="submit" class="btn bg-{{globalSetting('adminTheme')}} waves-effect">@lang('label.userSendEmail')</button>
                      <a type="button" href="{{ route('user list') }}" class="btn btn-default waves-effect m-l-5">@lang('label.cancel')</a>
                  </form>
              </div>
          </div>
      </div>
  </div>
@endsection