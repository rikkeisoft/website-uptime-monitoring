$(document).ready(function (e) {

    $('#select_all').change(function() {
        var checkboxes = $(this).closest('table').find('td').find(':checkbox');



        if($(this).is(':checked')) {
            checkboxes.not(this).prop('checked', this.checked);
            $('#SubmitDelete').prop('disabled', false);
        } else {
            checkboxes.not(this).prop('checked', false);
            $('#SubmitDelete').prop('disabled', true);
        }

        var arr = [];
        $('input[name="selectedIds[]"]:checked').each(function () {
            arr.push($(this).val());
        });
        //console.log(arr);
        $('#checkdelete').val(arr);

    });

    $('#SubmitDelete').on('click', function (e) {
        if (!confirm('Are you sure you want to delete?')) return;
        e.preventDefault();
        $('#deleteListSelectForm').submit();
    });
});

function clickCheckbox(){

    var arr = [];
    $('input[name="selectedIds[]"]:checked').each(function () {
        arr.push($(this).val());
    });
    //console.log(arr);
    $('#checkdelete').val(arr);


    if($('input[name="selectedIds[]"]:checked').length > 0){
        $('#SubmitDelete').prop('disabled', false);
    }else{
        $('#SubmitDelete').prop('disabled', true);
    }
}
