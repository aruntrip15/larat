@extends('layouts.admin')

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
                                    <th scope="row">{{ $key+1 }}</th>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->created_at }}</td>
                                    <td>
                                        <a href="{{ route('role add',['id' => $role->id ]) }}" type="button">
                                            <i class="material-icons">mode_edit</i>
                                        </a>
                                        <a href="javascript:void(0)" data-href="{{ route('role delete',['id' => $role->id ]) }}" data-message="@lang('message.confirmDelete')" data-method="delete" type="button" class="deleteWithModal">
                                            <i class="material-icons col-red">delete_forever</i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="align-right">
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