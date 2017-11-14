@extends('layouts.admin.admin')

@section('content')
    <div class="block-header">
        <h2>@isset ($permission->id) @lang('title.updatePermission') @else @lang('title.createPermission') @endisset</h2>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    <form method="post" action="{{ route('permission store') }}" class="form_validation" novalidate>
                        {!! csrf_field() !!}
                        <!-- If Edit mode -->
                        @isset ($permission->id)
                            <input type="hidden" name="id" value="{{$permission->id}}" />
                        @endisset
                        <label for="name">@lang('label.permissionName')</label>
                        <div class="form-group">
                            <div class="form-line {{ $errors->has('name') ? 'error focused' : '' }}">
                                <input id="name" name="name" class="form-control" placeholder="@lang('label.permissionName')" type="text" minlength="4" required value="{{ isset($permission->name) ? $permission->name : (old('name')?old('name'):'') }}">
                            </div>
                            <div class="help-info">Min. 4 characters</div>
                            @if ($errors->has('name'))
                                <label id="name-error" class="error" for="name">{{ $errors->first('name') }}</label>
                            @endif
                        </div>
                        <button type="submit" class="btn bg-{{globalSetting('adminTheme')}} waves-effect">@isset ($permission->id) @lang('label.update')  @else @lang('label.create') @endisset</button>
                        <a type="button" href="{{ route('permission list') }}" class="btn btn-default waves-effect m-l-5">@lang('label.cancel')</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection