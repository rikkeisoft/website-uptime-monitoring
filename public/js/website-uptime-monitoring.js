function toggleIdCheckbox() {
    var selectedIds = [];
    $('input[name="selectedIds[]"]:checked').each(function () {
        selectedIds.push($(this).val());
    });
    $('#checkdelete').val(selectedIds);


    if ($('input[name="selectedIds[]"]:checked').length > 0) {
        $('#SubmitDelete').prop('disabled', false);
    } else {
        $('#SubmitDelete').prop('disabled', true);
    }
}

$(document).ready(function (e) {
    $('#select_all').change(function () {
        var checkboxes = $(this).closest('table').find('td').find(':checkbox');

        if ($(this).is(':checked')) {
            checkboxes.not(this).prop('checked', this.checked);
            $('#SubmitDelete').prop('disabled', false);
        } else {
            checkboxes.not(this).prop('checked', false);
            $('#SubmitDelete').prop('disabled', true);
        }

        var selectedIds = [];
        $('input[name="selectedIds[]"]:checked').each(function () {
            selectedIds.push($(this).val());
        });
        $('#checkdelete').val(selectedIds);
    });

    $('#SubmitDelete').on('click', function (e) {
        e.preventDefault();
        if (!confirm('Are you sure you want to delete?')) {
            return;
        }

        $('#deleteListSelectForm').submit();
    });
});
