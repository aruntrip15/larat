@extends('layouts.admin.admin')

@section('content')
    <div class="block-header">
        <h2>@lang('title.setting') 
        @if(env('APP_ENV') != 'production') <a type="button"  href="{{ route('setting add') }}" class="m-l-15 btn bg-{{globalSetting('adminTheme')}} waves-effect"><i class="material-icons">add</i></a> @endif
        </h2>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body form-card">
                <form method="GET" id="listSearchForm">
                        <input type="hidden" name="orderBy" id="orderBy" value="{{$searchFormData['orderBy']}}" />
                        <input type="hidden" name="orderName" id="orderName" value="{{$searchFormData['orderName']}}" />
                        <div class="row clearfix">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control" placeholder="@lang('label.settingName')" type="text" name="name" value="{{$searchFormData['name']}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 button-demo">
                                <button type="submit" class="btn bg-{{globalSetting('adminTheme')}} waves-effect">@lang('label.search')</button>
                                <a href="{{ route('setting list') }}" type="button" class="btn btn-default waves-effect">@lang('label.reset')</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body table-responsive">
                    @if($settings->count())
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>
                                        <a class="listSortRecordLink" data-orderName="setting_key"  @if($searchFormData['orderName'] == 'setting_key') data-orderBy="{{$searchFormData['orderBy']}}" @else data-orderBy="asc" @endif>
                                            @lang('label.key') 
                                            @if($searchFormData['orderName'] == 'setting_key')
                                                @if($searchFormData['orderBy'] == 'asc')
                                                    <span class="caret"></span>
                                                @else
                                                    <span class="caret rotate180"></span>
                                                @endif
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a class="listSortRecordLink" data-orderName="setting_value"  @if($searchFormData['orderName'] == 'setting_value') data-orderBy="{{$searchFormData['orderBy']}}" @else data-orderBy="asc" @endif>
                                            @lang('label.value') 
                                            @if($searchFormData['orderName'] == 'setting_value')
                                                @if($searchFormData['orderBy'] == 'asc')
                                                    <span class="caret"></span>
                                                @else
                                                    <span class="caret rotate180"></span>
                                                @endif
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        @lang('label.action') 
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($settings as $key => $setting)
                                <tr>
                                    <th scope="row">{{ $key+1 }}</th>
                                    <td>{{ removeDblQuotes($setting->setting_key) }}</td>
                                    <td>{{ removeDblQuotes($setting->setting_value) }}</td>
                                    <td>
                                        <a href="{{ route('setting add',['id' => $setting->id ]) }}" {{ strtolower(trans('label.update')) }} type="button">
                                            <i class="material-icons">mode_edit</i>
                                        </a>
                                        @if(env('APP_ENV') != 'production')
                                        <a href="javascript:void(0)" title="{{ strtolower(trans('label.delete')) }}" data-href="{{ route('setting delete',['id' => $setting->id ]) }}" data-message="@lang('message.confirmDelete')" data-method="delete" type="button" class="deleteWithModal">
                                            <i class="material-icons col-red">delete_forever</i>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="align-right">
                            {{ $settings->appends(request()->query())->links() }}
                        </div>
                    @else
                        @lang('message.noRecords')
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection