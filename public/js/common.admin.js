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

    /** Add this class to form for jquery validation */
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


})