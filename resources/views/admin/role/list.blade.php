@extends('layouts.admin.admin')

@section('content')
    <div class="block-header">
        <h2>@lang('title.role') <a type="button"  href="{{ route('role add') }}" class="m-l-15 btn bg-{{globalSetting('adminTheme')}} waves-effect"><i class="material-icons">add</i></a></h2>
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
                                        <input class="form-control" placeholder="@lang('label.roleName')" type="text" name="name" value="{{$searchFormData['name']}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 button-demo">
                                <button type="submit" class="btn bg-{{globalSetting('adminTheme')}} waves-effect">@lang('label.search')</button>
                                <a href="{{ route('role list') }}" type="button" class="btn btn-default waves-effect">@lang('label.reset')</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body table-responsive">
                    @if($roles->count())
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="grid-checkbox"> 
                                        <input type="checkbox" id="selectAll" class="selectAllCheckBox chk-col-{{globalSetting('adminTheme')}}" />
                                        <label for="selectAll"></label>
                                    </th>
                                    <th>#</th>
                                    <th>
                                        <a class="listSortRecordLink" data-orderName="name"  @if($searchFormData['orderName'] == 'name') data-orderBy="{{$searchFormData['orderBy']}}" @else data-orderBy="asc" @endif>
                                            @lang('label.name') 
                                            @if($searchFormData['orderName'] == 'name')
                                                @if($searchFormData['orderBy'] == 'asc')
                                                    <span class="caret"></span>
                                                @else
                                                    <span class="caret rotate180"></span>
                                                @endif
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a class="listSortRecordLink" data-orderName="created_at"  @if($searchFormData['orderName'] == 'created_at') data-orderBy="{{$searchFormData['orderBy']}}" @else data-orderBy="asc" @endif>
                                            @lang('label.created') 
                                            @if($searchFormData['orderName'] == 'created_at')
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
                                @foreach ($roles as $key => $role)
                                <tr>
                                    <td class="grid-checkbox"> 
                                        <input type="checkbox" id="selectRecordCheckbox{{$key}}" class="selectRecordCheckBox chk-col-{{globalSetting('adminTheme')}}" value="{{$role->id}}" />
                                        <label for="selectRecordCheckbox{{$key}}"></label>
                                    </td>
                                    <th scope="row">{{ $key+1 }}</th>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->created_at }}</td>
                                    <td>
                                        <a href="{{ route('role add',['id' => $role->id ]) }}" title="{{ strtolower(trans('label.update')) }}" type="button">
                                            <i class="material-icons">mode_edit</i>
                                        </a>
                                        <a href="javascript:void(0)" title="{{ strtolower(trans('label.delete')) }}" data-id="{{$role->id}}" onclick="bulkActionWithForm(this, 'delete', '{{ route('role action') }}', '@lang('message.confirmDelete')')" type="button">
                                            <i class="material-icons col-red">delete_forever</i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="align-right">
                            <div class="card-footer-action">
                                <button type="button" class="btn bg-red waves-effect bulkActionBtn" onclick="bulkActionWithForm(this, 'delete', '{{ route('role action') }}', '@lang('message.confirmDeleteSelected')')" disabled><i class="material-icons col-white">delete_forever</i><span>@lang('label.delete')</span></button>
                            </div>
                            {{ $roles->appends(request()->query())->links() }}
                        </div>
                    @else
                        @lang('message.noRecords')
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection