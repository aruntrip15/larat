<!-- resouce/views/layouts/deletemodal -->

<!-- Default Size -->
<div class="modal fade" id="defaultDeleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" class="defaultModalLabel"></h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer custom-modal-footer">
                <a href="" type="button" class="deleteLink btn bg-{{globalSetting('adminTheme')}} waves-effect">@lang('label.yes')</a>
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">@lang('label.cancel')</button>
            </div>
        </div>
    </div>
</div>