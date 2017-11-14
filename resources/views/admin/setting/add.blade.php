@extends('layouts.admin.admin')

@section('content')
    <div class="block-header">
        <h2>@isset ($setting->id) @lang('title.updateSetting') @else @lang('title.createSetting') @endisset</h2>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    <form method="post" action="{{ route('setting store') }}" class="form_validation" novalidate>
                        {!! csrf_field() !!}
                        <!-- If Edit mode -->
                        @isset ($setting->id)
                            <input type="hidden" name="id" value="{{$setting->id}}" />
                        @endisset
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="name">@lang('label.settingName')</label>
                                <div class="form-group">
                                    <div class="form-line {{ $errors->has('name') ? 'error focused' : '' }}"> 
                                        <input id="name" name="name" class="form-control" placeholder="@lang('label.settingName')" type="text" minlength="3" required value="{{ isset($setting->setting_key) ? removeDblQuotes($setting->setting_key) : (old('name')?old('name'):'') }}" {{(env('APP_ENV') == 'production')?'readonly':''}}>
                                    </div>
                                    <div class="help-info">Min. 3 characters</div>
                                    @if ($errors->has('name'))
                                        <label id="name-error" class="error" for="name">{{ $errors->first('name') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="value">@lang('label.settingValue')</label>
                                <div class="form-group">
                                    <div class="form-line {{ $errors->has('value') ? 'error focused' : '' }}">
                                        <input id="value" name="value" class="form-control" placeholder="@lang('label.settingValue')" type="text" required value="{{ isset($setting->setting_value) ? removeDblQuotes($setting->setting_value) : (old('value')?old('value'):'') }}">
                                    </div>
                                    <div class="help-info">@if(env('APP_ENV') != 'production') Please add same setting to config/customSettings.php as fallback setting,  @endif Min. 3 characters</div>
                                    @if ($errors->has('value'))
                                        <label id="value-error" class="error" for="value">{{ $errors->first('value') }}</label>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row"  {{(env('APP_ENV') == 'production')? 'style=display:none':''}}>
                            <div class="col-sm-12">
                                <div class="form-group">
                                <label for="name">@lang('label.settingFor')</label>
                                <select name="settingFor" class="form-control show-tick">
                                    @isset ($setting->id)
                                    <option value="prod" {{($setting->setting_type == 'prod')?'selected="selected"':''}} >Production</option>
                                    <option value="dev" {{($setting->setting_type == 'dev')?'selected="selected"':''}}>Development</option>
                                    @else
                                        <option value="prod">Production</option>
                                        <option value="dev">Development</option>
                                    @endisset
                                    
                                </select>
                            </div>
                            </div>
                        </div>
                        <button type="submit" class="btn bg-{{globalSetting('adminTheme')}} waves-effect">@isset ($setting->id) @lang('label.update')  @else @lang('label.create') @endisset</button>
                        <a type="button" href="{{ route('setting list') }}" class="btn btn-default waves-effect m-l-5">@lang('label.cancel')</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection