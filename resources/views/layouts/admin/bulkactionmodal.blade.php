<!-- resouce/views/layouts/bulkactionmodal -->

<!-- Default Size -->
<div class="modal fade" id="bulkRecordActionModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document"post>
        <form id="bulkRecordActionForm" method="post" action="">
            {!! csrf_field() !!}
            <input type="hidden" id="bulkRecordAction" name="bulkRecordAction" value="" />
            <input type="hidden" id="bulkRecordIds" name="bulkRecordIds" value="" />
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" class="defaultModalLabel"></h4>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer custom-modal-footer">
                    <button type="submit" class="btn bg-{{globalSetting('adminTheme')}} waves-effect">@lang('label.yes')</a>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">@lang('label.cancel')</button>
                </div>
            </div>
        </form>
    </div>
</div>