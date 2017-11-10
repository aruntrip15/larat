@extends('layouts.admin')

@section('content')
    <div class="block-header">
        <h2>@isset ($role->id) @lang('title.updateRole') @else @lang('title.createRole') @endisset</h2>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    <form method="post" action="{{ route('role store') }}" class="form_validation" novalidate>
                        {!! csrf_field() !!}
                        <!-- If Edit mode -->
                        @isset ($role->id)
                            <input type="hidden" name="id" value="{{$role->id}}" />
                        @endisset
                        <label for="name">@lang('label.roleName')</label>
                        <div class="form-group">
                            <div class="form-line {{ $errors->has('name') ? 'error focused' : '' }}">
                                <input id="name" name="name" class="form-control" placeholder="@lang('label.roleName')" type="text" minlength="4" required value="{{ isset($role->name) ? $role->name : (old('name')?old('name'):'')  }}">
                            </div>
                            <div class="help-info">Min. 4 characters</div>
                            @if ($errors->has('name'))
                                <label id="name-error" class="error" for="name">{{ $errors->first('name') }}</label>
                            @endif
                        </div>
                        @isset($permissions)
                        <div class="form-group">
                            <label for="name">@lang('label.assignPermission')</label>
                            <select name="permissions[]" class="form-control show-tick" multiple data-live-search="true">
                                @foreach($permissions as $key => $val)

                                {{$selected = ""}}
                                @isset($selectedPermissions)
                                    @if (in_array($val->name, $selectedPermissions))
                                        {{$selected = 'selected="selected"'}}
                                    @endif
                                @endisset

                                <option value="{{$val->name}}" {{$selected}}>{{$val->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @endisset
                        <button type="submit" class="btn bg-{{globalSetting('adminTheme')}} waves-effect">@isset ($role->id) @lang('label.update')  @else @lang('label.create') @endisset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection