$(document).ready(function () {
    GetRoles();
});

function GetRoles() {
    $.ajax({
            type: 'POST',
            url: 'roles/all',
            data: {_token: $('input[name=_token]').val()},
            success: function (response) {
                $('#roles_container').html(response);
            },
            error: function () {
                toastr.error('Error occurred while loading');
            }
        }
    );
}