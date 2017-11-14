$(document).ready(function(){

    /** For Sorting list */
    $('.listSortRecordLink').on('click', function(){
        var orderName = $(this).data('ordername');
        var orderBy = $(this).data('orderby');

        if($('#orderName').val() == orderName){
            if($('#orderBy').val() == 'asc'){
                $('#orderBy').val('desc');
            }else{
                $('#orderBy').val('asc');
            }
        }else{
            $('#orderName').val(orderName);
            $('#orderBy').val(orderBy);
        }
        $('#listSearchForm').submit();
    });

    /** Add .form_validation class to form to enable jquery validation on that form */
    $('.form_validation').validate({
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        }
    });

    /** Default delete confirmation */
    $('.deleteWithModal').on('click', function(){
        $('#defaultDeleteModal .modal-body').html($(this).data('message'));
        $('#defaultDeleteModal .deleteLink').attr('href',$(this).data('href'));
        $('#defaultDeleteModal').modal('show');
    });

    /** Default delete confirmation */
    $('.selectAllCheckBox').on('click', function(){
        if($(this).is(':checked')){
            $(this).closest('table').find('.selectRecordCheckBox').each(function(){
                $(this).prop('checked', true);
            });
        }else{
            $(this).closest('table').find('.selectRecordCheckBox').each(function(){
                $(this).prop('checked', false);
            });
        }
        checkBulkActionBtnState();
    });

    $('.selectRecordCheckBox').on('change', function(){
        checkBulkActionBtnState();
    });

    $('.fileContainer input[type=file]').on('change', function(e){
        
        if(typeof e.target.files[0] != 'undefined'){
            var filename = e.target.files[0].name;
            $('.choosen-file-text').text(filename);

            var extensionData = filename.split('.');
            var extensionKey = extensionData.length - 1;
            var ext = extensionData[extensionKey];

            if( ext == 'jpg' || ext == 'jpeg' || ext == 'png'){
                readURL(this);
            }

            //Hide vaidation error on change of file
            $('#'+$(this).attr('id')+'-error').hide(); 
            $(this).parent().removeClass('error');

        }
    });
    
});

function checkBulkActionBtnState(){
    if ($(".selectRecordCheckBox:checked").length > 0)
    {
        // any one is checked
        $('.bulkActionBtn').removeAttr('disabled');
    }
    else
    {
       // none is checked
       $('.bulkActionBtn').attr('disabled','disabled');
    }    
}

//confirmationMessage - pass this as blank if no need to show confirmation popup
function bulkActionWithForm(element, action, postUrl, confirmationMessage){
    
    var selectedVal = [];

    if(typeof $(element).data('id') != 'undefined' && $(element).data('id') != ''){
         //single row selection with click on row icon
        selectedVal.push($(element).data('id'));
    }else{
        $(element).closest('.card').find('.selectRecordCheckBox').each(function(){     
            //Multiple row selection with click on delete button
            if($(this).is(':checked')){
                selectedVal.push($(this).val()); 
            }
        });
    }

    console.log(selectedVal);

    if(selectedVal.length){
        $('#bulkRecordActionForm').attr('action', postUrl);
        $('#bulkRecordAction').val(action);
        $('#bulkRecordIds').val(selectedVal.join(','));

        if(confirmationMessage != ''){
            $('#bulkRecordActionModal .modal-body').html(confirmationMessage);
            $('#bulkRecordActionModal').modal('show');
        }else{
            $('#bulkRecordActionForm').submit();
        }
    }

}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $('.data-image').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}