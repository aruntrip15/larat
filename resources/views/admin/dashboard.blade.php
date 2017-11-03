@extends('layouts.admin')

@section('content')
    <div class="block-header">
        <h2>@lang('title.dashboard')</h2>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="info-box-4" href="{{ route('user list') }}">
                <div class="icon">
                    <i class="material-icons col-{{globalSetting('adminTheme')}}">person</i>
                </div>
                <div class="content">
                    <div class="text col-{{globalSetting('adminTheme')}}">@lang('title.userManagement')</div>
                    <div class="number col-{{globalSetting('adminTheme')}}">123</div>
                </div>
            </a> 
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="info-box-4" href="{{ route('role list') }}">
                <div class="icon">
                    <i class="material-icons col-{{globalSetting('adminTheme')}}">group</i>
                </div>
                <div class="content">
                    <div class="text col-{{globalSetting('adminTheme')}}">@lang('title.roleManagement')</div>
                    <div class="number col-{{globalSetting('adminTheme')}}">123</div>
                </div>
            </a> 
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="info-box-4" href="{{ route('permission list') }}">
                <div class="icon">
                    <i class="material-icons col-{{globalSetting('adminTheme')}}">vpn_key</i>
                </div>
                <div class="content">
                    <div class="text col-{{globalSetting('adminTheme')}}">@lang('title.permissionManagement')</div>
                    <div class="number col-{{globalSetting('adminTheme')}}">123</div>
                </div>
            </a> 
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="info-box-4" href="{{ route('setting list') }}">
                <div class="icon">
                    <i class="material-icons col-{{globalSetting('adminTheme')}}">settings</i>
                </div>
                <div class="content">
                    <div class="text col-{{globalSetting('adminTheme')}}">@lang('title.globalSettingManagement')</div>
                    <div class="number col-{{globalSetting('adminTheme')}}">123</div>
                </div>
            </a> 
        </div>
    </div>
@endsection