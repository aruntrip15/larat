@extends('layouts.admin')

@section('content')
    <div class="block-header">
        <h2>@isset ($user->id) @lang('title.updateUser') @else @lang('title.createUser') @endisset</h2>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    <form method="post" action="{{ route('user store') }}" class="form_validation" novalidate>
                        {!! csrf_field() !!}
                        <!-- If Edit mode -->
                        @isset ($user->id)
                            <input type="hidden" name="id" value="{{$user->id}}" />
                        @endisset
                        <label for="name">@lang('label.userName')</label>
                        <div class="form-group">
                            <div class="form-line {{ $errors->has('name') ? 'error focused' : '' }}">
                                <input id="name" name="name" class="form-control" placeholder="@lang('label.userName')" type="text" minlength="4" required value="{{ isset($user->name) ? $user->name : (old('name')?old('name'):'') }}">
                            </div>
                            <div class="help-info">Min. 4 characters</div>
                            @if ($errors->has('name'))
                                <label id="name-error" class="error" for="name">{{ $errors->first('name') }}</label>
                            @endif
                        </div>
                        <label for="name">@lang('label.userEmail')</label>
                        <div class="form-group">
                            <div class="form-line {{ $errors->has('email') ? 'error focused' : '' }}">
                                <input id="email" name="email" class="form-control" placeholder="@lang('label.userEmail')" type="email" required value="{{ isset($user->email) ? $user->email : (old('email')?old('email'):'') }}">
                            </div>
                            <div class="help-info">Email address</div>
                            @if ($errors->has('email'))
                                <label id="email-error" class="error" for="email">{{ $errors->first('email') }}</label>
                            @endif
                        </div>
                        <label for="name">@lang('label.userPwd')</label>
                        <div class="form-group">
                            <div class="form-line {{ $errors->has('password') ? 'error focused' : '' }}">
                                <input id="password" name="password" class="form-control" minlength="6" placeholder="@lang('label.userPwd')" type="password"  value="" {{(!isset($user->id))? 'required' : ''}} >
                            </div>
                            <div class="help-info">Min.6 characters</div>
                            @if ($errors->has('password'))
                                <label id="password-error" class="error" for="password">{{ $errors->first('password') }}</label>
                            @endif
                        </div>
                        <label for="name">@lang('label.userConfirmPwd')</label>
                        <div class="form-group">
                            <div class="form-line {{ $errors->has('confirmPassword') ? 'error focused' : '' }}">
                                <input id="password_confirmation" name="password_confirmation" equalTo="#password" class="form-control" minlength="6" placeholder="@lang('label.userConfirmPwd')" type="password"  value="" {{(!isset($user->id))? 'required' : ''}}>
                            </div>
                            <div class="help-info">Min. 6 characters, Equal to Password</div>
                            @if ($errors->has('confirmPassword'))
                                <label id="password_confirmation-error" class="error" for="password_confirmation">{{ $errors->first('password_confirmation') }}</label>
                            @endif
                        </div>
                        @isset($roles)
                        <div class="form-group">
                            <label for="name">@lang('label.assignRole')</label>
                            <select name="role" class="form-control show-tick" data-live-search="true">
                                <option value="">@lang('label.noneSelected')</option>
                                @foreach($roles as $key => $val)

                                {{$selected = ""}}
                                @isset($selectedRoles)
                                    @if (in_array($val->name, $selectedRoles))
                                        {{$selected = 'selected="selected"'}}
                                    @endif
                                @endisset

                                <option value="{{$val->name}}" {{$selected}}>{{$val->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @endisset
                        <button type="submit" class="btn bg-{{globalSetting('adminTheme')}} waves-effect">@isset ($user->id) @lang('label.update')  @else @lang('label.create') @endisset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection