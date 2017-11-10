@extends('layouts.admin')

@section('content')
<div class="block-header">
  <h2>
    @lang('title.permission')
    <a type="button"  href="{{ route('permission add') }}" class="m-l-15 btn bg-{{globalSetting('adminTheme')}} waves-effect">
      <i class="material-icons">add</i>
    </a>
  </h2>
</div>

<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="body form-card">
        <form method="GET" id="listSearchForm">
          <input type="hidden" name="orderBy" id="orderBy" value="{{$searchFormData['orderBy']}}" />
          <input type="hidden" name="order" id="order" value="{{$searchFormData['order']}}" />
          <div class="row clearfix">
            <div class="col-md-4">
              <div class="form-group">
                <div class="form-line">
                  <input class="form-control" placeholder="@lang('label.permissionName')" type="text" name="name" value="{{$searchFormData['name']}}">
                </div>
              </div>
            </div>
            <div class="col-md-4 button-demo">
              <button type="submit" class="btn bg-{{globalSetting('adminTheme')}} waves-effect">@lang('label.search')</button>
              <a href="{{ route('permission list') }}" type="button" class="btn btn-default waves-effect">@lang('label.reset')</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="body table-responsive">
        @if($permissions->count())
          <table class="table table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>
                  <a class="listSortRecordLink" data-orderBy="name" @if($searchFormData['orderBy'] == 'name') data-order="{{$searchFormData['order']}}" @else data-order="asc" @endif>
                    @lang('label.name') 
                    @if($searchFormData['orderBy'] == 'name')
                      @if($searchFormData['order'] == 'asc')
                        <span class="caret"></span>
                      @else
                        <span class="caret rotate180"></span>
                      @endif
                    @endif
                  </a>
                </th>
                <th>
                  <a class="listSortRecordLink" data-orderBy="created_at" @if($searchFormData['orderBy'] == 'created_at') data-order="{{$searchFormData['order']}}" @else data-order="asc" @endif>
                    @lang('label.created') 
                    @if($searchFormData['orderBy'] == 'created_at')
                      @if($searchFormData['order'] == 'asc')
                        <span class="caret"></span>
                      @else
                        <span class="caret rotate180"></span>
                      @endif
                    @endif
                  </a>
                </th>
                <th>@lang('label.action')</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($permissions as $key => $permission)
              <tr>
                <th scope="row">{{ $key+1 }}</th>
                <td>{{ $permission->name }}</td>
                <td>{{ $permission->created_at }}</td>
                <td>
                  <a href="{{ route('permission add',['id' => $permission->id ]) }}" type="button"><i class="material-icons">mode_edit</i></a>
                  <a href="javascript:void(0)" data-href="{{ route('permission delete',['id' => $permission->id ]) }}" data-message="@lang('message.confirmDelete')" data-method="delete" type="button" class="deleteWithModal">
                    <i class="material-icons col-red">delete_forever</i>
                  </a>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
          <div class="align-right">
            {{ $permissions->appends(request()->query())->links() }}
          </div>
        @else
          @lang('message.noRecords')
        @endif
      </div>
    </div>
  </div>
</div>
@endsection