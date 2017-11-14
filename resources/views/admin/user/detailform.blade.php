<div class="block-header">
    <h2>@lang('title.details')</h2>
</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">
                <form method="post" action="{{ route('user store') }}" class="form_validation" enctype="multipart/form-data"  novalidate>
                    {!! csrf_field() !!}
                    <!-- If Edit mode -->
                    @isset ($user->id)
                        <input type="hidden" name="id" value="{{$user->id}}" />
                    @endisset
                    <label for="avatar">@lang('label.userImage')</label>
                    <div class="form-group">
                        <div class="form-line {{ $errors->has('avatar') ? 'error focused' : '' }}">
                            <input name="avatar" type="file" id="avatar"/>
                        </div>
                        <div class="help-info">jpg, jpeg, png</div>
                        @if ($errors->has('avatar'))
                            <label id="avatar-error" class="error" for="avatar">{{ $errors->first('avatar') }}</label>
                        @endif
                    </div>
                    <button type="submit" class="btn bg-{{globalSetting('adminTheme')}} waves-effect">@isset ($user->id) @lang('label.update')  @else @lang('label.create') @endisset</button>
                    <a type="button" href="{{ route('user list') }}" class="btn btn-default waves-effect m-l-5">@lang('label.cancel')</a>
                </form>
            </div>
        </div>
    </div>
</div>