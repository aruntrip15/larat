$(document).ready(function(){

    /** For Sorting list */
    $('.listSortRecordLink').on('click', function(event) {

      var orderBy = $(this).data('orderby');
      var order = $(this).data('order');

      if ($('#orderBy').val() == orderBy) {
        if ($('#order').val() == 'asc') {
          $('#order').val('desc');
        }
        else {
          $('#order').val('asc');
        }
      }
      else{
        $('#orderBy').val(orderBy);
        $('#order').val(order);
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