@extends('layouts.admin.admin')

@section('content')
    <div class="block-header">
        <h2>@lang('label.chngPwd')</h2>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    <form method="post" action="{{ route('user password store') }}" class="form_validation" novalidate>
                        {!! csrf_field() !!}
                        <!-- If Edit mode -->
                        <input type="hidden" name="id" value="{{$user->id}}" />
                        
                            <label for="name">@lang('label.userNewPwd')</label>
                            <div class="form-group">
                                <div class="form-line {{ $errors->has('password') ? 'error focused' : '' }}">
                                    <input id="password" name="password" class="form-control" minlength="6" required placeholder="@lang('label.userNewPwd')" type="password"  value="" {{(!isset($user->id))? 'required' : ''}} >
                                </div>
                                <div class="help-info">Min.6 characters</div>
                                @if ($errors->has('password'))
                                    <label id="password-error" class="error" for="password">{{ $errors->first('password') }}</label>
                                @endif
                            </div>
                       
                            <label for="name">@lang('label.userConfirmPwd')</label>
                            <div class="form-group">
                                <div class="form-line {{ $errors->has('confirmPassword') ? 'error focused' : '' }}">
                                    <input id="password_confirmation" name="password_confirmation" equalTo="#password" minlength="6" required class="form-control" placeholder="@lang('label.userConfirmPwd')" type="password"  value="" {{(!isset($user->id))? 'required' : ''}}>
                                </div>
                                <div class="help-info">Min. 6 characters, Equal to Password</div>
                                @if ($errors->has('confirmPassword'))
                                    <label id="password_confirmation-error" class="error" for="password_confirmation">{{ $errors->first('password_confirmation') }}</label>
                                @endif
                            </div>
                            <button type="submit" class="btn bg-{{globalSetting('adminTheme')}} waves-effect">@lang('label.update')</button>
                            <a type="button" href="{{ route('user add',['id' => $user->id ]) }}" class="btn btn-default waves-effect m-l-5">@lang('label.cancel')</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection