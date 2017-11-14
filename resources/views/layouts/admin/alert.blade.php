<!-- resouce/views/layouts/alert -->

<div class="alert alert-{{session('alert.type')}} {{ (session('alert.type') == 'success') ? 'bg-green' : '' }} {{ (session('alert.type') == 'error') ? 'bg-red' : '' }} alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    @if(session('alert.title'))<strong class="alert-title">{{session('alert.title')}}</strong><br>@endif
    {{session('alert.message')}}
</div>