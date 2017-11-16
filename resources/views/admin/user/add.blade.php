@extends('layouts.admin.admin')

@section('content')
    <div class="block-header with-right-btn clearfix">
        <h2>@isset ($user->id) @lang('title.updateUser') @else @lang('title.createUser') @endisset</h2>
        @isset ($user->id)
        <div class="right-btn-panel">
            <a type="button" href="{{ route('user password',['id' => $user->id ]) }}" class="btn bg-{{globalSetting('adminTheme')}} waves-effect">@lang('label.chngPwd')</a>
        </div>
        @endisset
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    <form method="post" action="{{ route('user store') }}" class="form_validation"  enctype="multipart/form-data" novalidate>
                        {!! csrf_field() !!}
                        @isset ($user->id)
                            <input type="hidden" name="id" value="{{$user->id}}" />
                        @endisset

                        <div class="row">
                        
                            <div class="col-lg-6 col-md-6 col-sm-6">
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
                                @empty($user->id)
                                    <label for="name">@lang('label.userPwd')</label>
                                    <div class="form-group">
                                        <div class="form-line {{ $errors->has('password') ? 'error focused' : '' }}">
                                            <input id="password" name="password" class="form-control" minlength="6" placeholder="@lang('label.userPwd')" type="password"  value="{{$randomPassword}}" {{(!isset($user->id))? 'required' : ''}} >
                                        </div>
                                        <div class="help-info">Min.6 characters</div>
                                        @if ($errors->has('password'))
                                            <label id="password-error" class="error" for="password">{{ $errors->first('password') }}</label>
                                        @endif
                                    </div>
                                @endempty
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

                            </div>
                            
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <label for="avatar">@lang('label.userImage')</label>
                                <div class="form-group clearfix p-t-15">
                                    <div class="{{ $errors->has('avatar') ? 'error focused' : '' }} form-line" style="overflow:hidden;">
                                        <div class="user-form-image m-r-15">
                                            @isset ($user->id)
                                                <img class="data-image" src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="User">
                                            @else
                                                <img class="data-image" src="{{ asset('storage/avatars/default-avatar.jpg') }}" alt="User">
                                            @endisset
                                        </div>
                                        <div class="fileContainer  m-b-10">
                                            <i class="material-icons">file_upload</i>
                                            <input name="avatar" type="file" accept="jpg,png,jpeg" id="avatar"/>
                                        </div>
                                       
                                        <div class="user-form-image-text choosen-file-text m-l-15 m-t-15 col-{{globalSetting('adminTheme')}} font-bold">
                                        </div>
                                    </div>
                                    <div class="help-info">Allowed extensions are jpg, jpeg, png upto size of 2MB</div>
                                    @if ($errors->has('avatar'))
                                        <label id="avatar-error" class="error" for="avatar">{{ $errors->first('avatar') }}</label>
                                    @endif
                                </div>

                            </div>
                        </div>

                            <button type="submit" class="btn bg-{{globalSetting('adminTheme')}} waves-effect">@isset ($user->id) @lang('label.update')  @else @lang('label.create') @endisset</button>
                            <a type="button" href="{{ route('user list') }}" class="btn btn-default waves-effect m-l-5">@lang('label.cancel')</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection