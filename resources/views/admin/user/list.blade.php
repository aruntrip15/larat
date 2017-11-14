@extends('layouts.admin.admin')

@section('content')
    <div class="block-header">
        <h2>@lang('title.user') <a type="button" href="{{route('user add')}}" class="m-l-15 btn bg-{{globalSetting('adminTheme')}} waves-effect"><i class="material-icons">add</i></a></h2>
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
                                        <input class="form-control" placeholder="@lang('label.nameOrEmail')" type="text" name="nameOrEmail" value="{{$searchFormData['nameOrEmail']}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control show-tick" name="role">
                                    <option value="">@lang('label.allRoles')</option>
                                    @foreach ($roles as $role)
                                        @if ($searchFormData['role'] != '' && $searchFormData['role'] == $role->id)
                                            <option value="{{$role->id}}" selected="selected">{{$role->name}}</option>
                                        @else
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 button-demo">
                                <button type="submit" class="btn bg-{{globalSetting('adminTheme')}} waves-effect">@lang('label.search')</button>
                                <a href="{{ route('user list') }}" type="button" class="btn btn-default waves-effect">@lang('label.reset')</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body table-responsive">
                    
                    @if($users->count())
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="grid-checkbox"> 
                                        <input type="checkbox" id="selectAll" class="selectAllCheckBox chk-col-{{globalSetting('adminTheme')}}" />
                                        <label for="selectAll"></label>
                                    </th>
                                    <th>#</th>
                                    <th>
                                        <a class="listSortRecordLink" data-orderName="users.name"  @if($searchFormData['orderName'] == 'users.name') data-orderBy="{{$searchFormData['orderBy']}}" @else data-orderBy="asc" @endif>
                                            @lang('label.name')
                                            @if($searchFormData['orderName'] == 'users.name')
                                                @if($searchFormData['orderBy'] == 'asc')
                                                    <span class="caret"></span>
                                                @else
                                                    <span class="caret rotate180"></span>
                                                @endif
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a class="listSortRecordLink" data-orderName="users.email" @if($searchFormData['orderName'] == 'users.email') data-orderBy="{{$searchFormData['orderBy']}}" @else data-orderBy="asc" @endif>
                                            @lang('label.email') 
                                            @if($searchFormData['orderName'] == 'users.email')
                                                @if($searchFormData['orderBy'] == 'asc')
                                                    <span class="caret"></span>
                                                @else
                                                    <span class="caret rotate180"></span>
                                                @endif
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a class="listSortRecordLink" data-orderName="roles.name" @if($searchFormData['orderName'] == 'roles.name') data-orderBy="{{$searchFormData['orderBy']}}" @else data-orderBy="asc" @endif>
                                            @lang('label.role')
                                            @if($searchFormData['orderName'] == 'roles.name')
                                                @if($searchFormData['orderBy'] == 'asc')
                                                    <span class="caret"></span>
                                                @else
                                                    <span class="caret rotate180"></span>
                                                @endif
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a class="listSortRecordLink" data-orderName="users.created_at" @if($searchFormData['orderName'] == 'users.created_at') data-orderBy="{{$searchFormData['orderBy']}}" @else data-orderBy="asc" @endif>
                                            @lang('label.created') 
                                            @if($searchFormData['orderName'] == 'users.created_at')
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
                                @foreach ($users as $key => $user)
                                <tr>
                                    <td class="grid-checkbox"> 
                                        <input type="checkbox" id="selectRecordCheckbox{{$key}}" class="selectRecordCheckBox chk-col-{{globalSetting('adminTheme')}}" value="{{$user->id}}" />
                                        <label for="selectRecordCheckbox{{$key}}"></label>
                                    </td>
                                    <th scope="row">{{ $key+1 }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role_name }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        <a title="{{ strtolower(trans('label.update')) }}" href="{{ route('user add',['id' => $user->id ]) }}">
                                            <i class="material-icons">mode_edit</i>
                                        </a>
                                        <a  title="{{ strtolower(trans('label.chngPwd')) }}"  href="{{ route('user password',['id' => $user->id ]) }}" type="button">
                                            <i class="material-icons">vpn_key</i>
                                        </a>
                                        <a  title="{{ strtolower(trans('label.delete')) }}" href="javascript:void(0)" data-id="{{$user->id}}" onclick="bulkActionWithForm(this, 'delete', '{{ route('user action') }}', '@lang('message.confirmDelete')')" type="button">
                                            <i class="material-icons col-red">delete_forever</i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="align-right">
                            <div class="card-footer-action">
                                <button type="button" class="btn bg-red waves-effect bulkActionBtn" onclick="bulkActionWithForm(this, 'delete', '{{ route('user action') }}', '@lang('message.confirmDeleteSelected')')" disabled><i class="material-icons col-white">delete_forever</i><span>@lang('label.delete')</span></button>
                            </div>
                            {{ $users->appends(request()->query())->links() }}
                        </div>
                    @else
                        @lang('message.noRecords')
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection